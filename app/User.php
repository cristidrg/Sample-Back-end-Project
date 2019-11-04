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


    public function orgs()
    {
        return $this->belongsToMany('App\Org', 'orgs_users', 'user_id', 'org_id');
    }
}
