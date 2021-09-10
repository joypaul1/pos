<?php

namespace App\Traits;

use Carbon\Carbon;

/**
 *
 * @var boot funciton use for autotimestamp ----->[joy]
 */

trait AutoTimeStamp
{
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
}

