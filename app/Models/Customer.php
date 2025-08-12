<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name','dob','address','email','contact_info'];
    public function quotations() {
        
        return $this->hasMany(Quotation::class);
    }
}

