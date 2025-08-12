<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['customer_id','quotation_code','quotation_date','grand_total','total_items'];
    public function customer() { 
        return $this->belongsTo(Customer::class);
    }
    public function items() { 
        return $this->hasMany(QuotationItem::class); 
    }
}

