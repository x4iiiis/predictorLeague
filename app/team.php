<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    protected $fillable = [
        'name', 'emblem', 'league'
    ];
}
