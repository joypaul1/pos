<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function project()
    {
    	return $this->belongsTo(Project::class,'project_id','id');
    }
}
