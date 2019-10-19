<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'title'];
    protected $attributes = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'title' => ''
    ];
}
