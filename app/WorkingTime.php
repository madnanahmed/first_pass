<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    protected $table = 'working_time';

    protected $fillable = [
            'user_id', 'day', 'data', 'is_enabled'
        ];
}
