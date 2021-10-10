<?php

namespace App\Models;

use App\Model\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InvoiceInstallment extends Model
{
    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_id', 'id');
    }

    public function getDayCountAttribute()
    {
        $date = Carbon::parse($this->date);;
        $now = Carbon::now()->format('Y-m-d');
        if($now > $date){
            $diff = $date->diffInDays($now);
            return $diff;
        }
        return 0;


    }

}
