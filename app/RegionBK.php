<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionBK extends Model
{
    protected $table = 'regions_bk';

    protected $fillable = ['title', 'code', 'price', 'data'];
}
