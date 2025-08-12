<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\QuotationController;
use App\Http\Controllers\MailController;

Route::apiResource('customers', CustomerController::class);
// (simple) top-level resource for quotations
Route::apiResource('quotations', QuotationController::class);

Route::get('/customers/check-email', function (Request $request) {
    $request->validate([
        'email' => 'required|email|unique:customers,email'
    ]);
    
    return response()->json(['message' => 'Email is available']);
});

Route::post('quotations/{quotation}/send', [QuotationController::class,'sendToCustomer']);
Route::post('/quotations', [QuotationController::class, 'store']);

Route::get('quotations/{quotation}/items', function (Quotation $quotation) {
    return $quotation->items;
});

Route::get('/send-quotation/{id}', [MailController::class, 'sendQuotationEmail'])
    ->name('send.quotation');

Route::post('/quotations/{quotation}/send-email', [MailController::class, 'sendQuotationEmail']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
