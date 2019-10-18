<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prop extends Model
{ 
    protected $fillable = ['title', 'url'];
    protected $attributes = [
        'title' => '',
        'url' => '',
    ];

    public function monitor()
    {
        return $this->hasOne('Spatie\UptimeMonitor\Models\Monitor', 'url', 'url');
    }

    public function technologies()
    {
        return $this->hasMany('App\Technology');
    }

    public function org()
    {
        return $this->belongsTo('App\Org');
    }
}