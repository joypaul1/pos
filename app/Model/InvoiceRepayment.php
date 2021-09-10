<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceRepayment extends Model
{
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
