<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function project()
    {
    	return $this->belongsTo(Project::class,'project_id','id');
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function sellPrice()
    {
        return $this->belongsTo(PurchaseDetail::class, 'product_id', 'id')->select('product_id', 'selling_price');
    }
}
