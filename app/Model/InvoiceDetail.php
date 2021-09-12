<?php

namespace App\Model;

use App\Traits\AutoTimeStamp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $guarded= ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->fill([
                'created_at' => Carbon::now(),
                'updated_by' => auth()->id(),
                'created_by' => auth()->id(),
            ]);
        });
        static::updating(function ($model) {
            $model->fill([
                'updated_at' => Carbon::now(),
                'updated_by' => auth()->id(),

            ]);
        });
        static::deleting(function($model){
            $model->fill([
                'updated_by' => auth()->id(),
                'updated_at' => Carbon::now(),
            ]);
        });
    }

    public function product(){
    	return $this->belongsTo(Product::class,'product_id','id');
    }

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
