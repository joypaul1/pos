<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class Purchase extends Model
{
    public function purchase_details(){
        return $this->hasMany(PurchaseDetail::class,'purchase_id','id');
    }

    public function purchase_payment(){
        return $this->hasOne(PurchasePayment::class,'purchase_id','id');
    }

    public function purchase_payment_details(){
        return $this->hasMany(PurchasePaymentDetail::class,'purchase_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
