<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];
    public function project()
    {
    	return $this->belongsTo(Project::class,'project_id','id');
    }
}
