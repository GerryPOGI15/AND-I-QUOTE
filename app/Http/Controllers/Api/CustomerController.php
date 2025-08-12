<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // list all customers with their quotations & items
        return Customer::with('quotations.items')->get();
    }
    
    public function store(Request $request) {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'dob' => 'required|date',
                'email' => 'required|email|unique:customers,email',
                'contact_info' => 'required|string',
                'address' => 'nullable|string',
            ]);
            
            return Customer::create($data);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Check if the error is specifically for the email uniqueness
            if (array_key_exists('email', $e->errors())) {
                return response()->json([
                    'message' => 'The given email address is already in use.',
                    'errors' => $e->errors()
                ], 422);
            }
            
            throw $e;
        }
    }
    
    public function show(Customer $customer) {
        return $customer->load('quotations.items');
    }
    
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name'         => 'required|string',
            'dob'          => 'required|date',
            'email'        => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($customer->id),
            ],
            'contact_info' => 'required|string',
            'address'      => 'nullable|string',
        ]);

        $customer->fill($data);
        $customer->save();

        return response()->json($customer->fresh()->load('quotations'));
    }
    
    public function destroy(Customer $customer) {
        // DB foreign keys cascade will delete related quotations & items
        $customer->delete();
        return response()->json(['message'=>'Customer and related quotations deleted']);
    }
    
}
