<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use App\Models\InvoiceInstallment;
use App\Traits\AutoTimeStamp;
use Carbon\Carbon;

class Invoice extends Model
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


    public function invoice_details(){
        return $this->hasMany(InvoiceDetail::class,'invoice_id','id');
    }

    public function invoice_payment(){
        return $this->hasOne(InvoicePayment::class,'invoice_id','id');
    }

    public function invoice_payment_details(){
        return $this->hasMany(InvoicePaymentDetail::class,'invoice_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }

    public function installment()
    {
        return $this->hasMany(InvoiceInstallment::class, 'invoice_id', 'id');
    }
    public function lastesInstallment()
    {
        return $this->hasOne(InvoiceInstallment::class, 'invoice_id', 'id')->latest();
    }

     public function getDayCountAttribute()
    {
        if($this->installment()->first()){
            $date   = Carbon::parse($this->installment()->first()->date);
            $now    = Carbon::now();
            $diff   = $date->diffInDays($now);
            return $diff;
        }
        return false;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
