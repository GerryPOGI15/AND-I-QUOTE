<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\QuotationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class QuotationController extends Controller
{
    public function show($id)
    {
        return Quotation::with(['customer', 'items'])->findOrFail($id);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'quotation_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_cost' => 'required|numeric|min:0',
        ]);
    
        DB::beginTransaction();
    
        try {
            $totalItems = count($validated['items']);
            $grandTotal = 0;
    
            // Create quotation
            $quotation = Quotation::create([
                'customer_id' => $validated['customer_id'],
                'quotation_code' => 'QT-' . time(), // simple unique code
                'quotation_date' => $validated['quotation_date'],
                'grand_total' => 0, // temporary
                'total_items' => $totalItems,
            ]);
    
            // Save items
            foreach ($validated['items'] as $item) {
                $subtotal = $item['quantity'] * $item['unit_cost'];
                $grandTotal += $subtotal;
    
                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'product_name' => $item['product_name'],
                    'description' => $item['description'] ?? null,
                    'quantity' => $item['quantity'],
                    'unit_cost' => $item['unit_cost'],
                    'subtotal' => $subtotal,
                ]);
            }
    
            // Update grand total
            $quotation->update(['grand_total' => $grandTotal]);
    
            // Load the relationship for the response
            $quotation->load('items');
    
            DB::commit();
    
            return response()->json([
                'message' => 'Quotation created successfully', 
                'quotation' => $quotation
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendToCustomer(Quotation $quotation)
    {
        $customer = $quotation->customer;
        $html = View::make('emails.quotation', compact('quotation','customer'))->render();
    
        $payload = [
            'sender' => ['name' => config('mail.from.name'), 'email' => config('mail.from.address')],
            'to' => [['email' => $customer->email, 'name' => $customer->name]],
            'subject' => "Quotation {$quotation->quotation_code}",
            'htmlContent' => $html
        ];
    
        // optional: attach generated PDF
        // $pdf = \PDF::loadView('pdfs.quotation', compact('quotation','customer'))->output();
        // $payload['attachment'] = [['content' => base64_encode($pdf), 'name' => "quotation-{$quotation->id}.pdf"]];
    
        $resp = Http::withHeaders([
            'api-key' => env('BREVO_API_KEY'),
            'Content-Type' => 'application/json'
        ])->post('https://api.brevo.com/v3/smtp/email', $payload);
    
        if ($resp->successful()) return response()->json(['message'=>'Sent','response'=>$resp->json()]);
        return response()->json(['error'=>$resp->body()], $resp->status());
    }

    public function destroy($id)
    {
        $quotation = Quotation::find($id);

        if (!$quotation) {
            return response()->json(['message' => 'Quotation not found'], 404);
        }

        try {
            $quotation->delete();
            return response()->json(['message' => 'Quotation deleted']);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Failed to delete quotation: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete quotation'], 500);
        }
    }

        
}
