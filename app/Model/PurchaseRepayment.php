<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseRepayment extends Model
{
    public function purchase(){
        return $this->belongsTo(Purchase::class,'purchase_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
}
