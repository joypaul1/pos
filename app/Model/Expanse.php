<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expanse extends Model
{
    protected $guarded = ['id'];
    public function project()
    {
    	return $this->belongsTo(Project::class,'project_id','id');
    }

    public function expanse_type()
    {
    	return $this->belongsTo(ExpanseType::class,'expanse_type_id','id');
    }
}
