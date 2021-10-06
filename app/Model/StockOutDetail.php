<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StockOutDetail extends Model
{

    protected $guarded =['id'];

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function reason(){
    	return $this->belongsTo(Reason::class,'reason_id','id');
    }
}
