<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;


class InvoicePaymentDetail extends Model
{


    public function invoice(){
    	return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
