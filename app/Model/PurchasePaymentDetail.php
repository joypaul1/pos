<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class PurchasePaymentDetail extends Model
{

    protected $guarded=['id'];

    public function purchase(){
    	return $this->belongsTo(Purchase::class,'purchase_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
