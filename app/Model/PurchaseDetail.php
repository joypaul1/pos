<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function sub_category(){
    	return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function project(){
    	return $this->belongsTo(Project::class,'project_id','id');
    }

    public function supplier(){
    	return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class,'purchase_id','id');
    }
}
