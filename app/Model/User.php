<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Role;

class User extends Model
{
    protected $table = "users";

    public function role(){
    	return $this->belongsTo(Role::class, 'role_id','id');
    }
}
