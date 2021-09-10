<?php

namespace App\Model;

use App\Traits\AutoTimeStamp;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
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


    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}
