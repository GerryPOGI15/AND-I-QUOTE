<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf; // Require barryvdh/laravel-dompdf
use App\Models\Quotation;
use App\Models\Customer;

class MailController extends Controller
{
    public function sendQuotationEmail($quotationId)
    {
        $quotation = Quotation::with(['customer', 'items'])->findOrFail($quotationId);
        $customer = $quotation->customer;

        $apikey = env('BREVO_API_KEY');

        // Generate PDF
        $pdf = Pdf::loadHTML($this->generateQuotationEmailHtml($quotation, $customer));
        $pdfContent = $pdf->output();
        $pdfBase64 = base64_encode($pdfContent);

        // Send email with Brevo API
        $response = Http::withHeaders([
            'api-key' => $apikey,
            'Content-Type' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => 'AND I QUOTE',
                'email' => env('BREVO_SENDER_EMAIL'),
            ],
            'to' => [
                ['email' => $customer->email]
            ],
            'subject' => 'Your Quotation #' . $quotation->quotation_code,
            'htmlContent' => "<p>Hello {$customer->name},<br> Please find your quotation attached.</p>",
            'attachment' => [
                [
                    'name' => "Quotation-{$quotation->quotation_code}.pdf",
                    'content' => $pdfBase64
                ]
            ]
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Email sent successfully with attachment']);
        } else {
            return response()->json([
                'message' => 'Failed to send email',
                'error' => $response->body()
            ], 500);
        }
    }

    private function generateQuotationEmailHtml(Quotation $quotation, Customer $customer)
    {
        $itemsHtml = '';
        foreach ($quotation->items as $item) {
            $itemsHtml .= "
                <tr>
                    <td>{$item->product_name}</td>
                    <td>{$item->description}</td>
                    <td>{$item->quantity}</td>
                    <td>$" . number_format($item->unit_cost, 2) . "</td>
                    <td>$" . number_format($item->quantity * $item->unit_cost, 2) . "</td>
                </tr>
            ";
        }

        return "
        <html>
        <body>
            <h1>Quotation #{$quotation->quotation_code}</h1>
            
            <h2>Customer Information</h2>
            <p><strong>Name:</strong> {$customer->name}</p>
            <p><strong>Date of Birth:</strong> {$customer->dob}</p>
            <p><strong>Address:</strong> " . (!empty($customer->address) ? $customer->address : 'N/A') . "</p>
            <p><strong>Email:</strong> {$customer->email}</p>
            <p><strong>Contact:</strong> {$customer->contact_info}</p>
            
            <h2>Quotation Details</h2>
            <p><strong>Date:</strong> {$quotation->quotation_date}</p>
            <p><strong>Total Items:</strong> {$quotation->items->count()}</p>
            <p><strong>Grand Total:</strong> $" . number_format($quotation->grand_total, 2) . "</p>
            
            <h3>Items</h3>
            <table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; width: 100%;'>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {$itemsHtml}
                </tbody>
            </table>
            
            <p>Thank you for your business!</p>
            <p>AND I QUOTE Team</p>
        </body>
        </html>
        ";
    }
}
