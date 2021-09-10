<?php

namespace App\Models;

use App\Model\Invoice;
use Illuminate\Database\Eloquent\Model;

class InvoiceInstallment extends Model
{
    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'invoice_id', 'id');
    }



}
