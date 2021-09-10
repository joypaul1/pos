<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentDueLog extends Model
{
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
