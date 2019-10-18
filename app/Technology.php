<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['name'];
    protected $attributes = [
        'name' => ''
    ];
}
