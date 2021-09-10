<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;

class StockOut extends Model
{
    public function stock_out_details(){
        return $this->hasMany(StockOutDetail::class,'stock_out_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
