<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prop extends Model
{ 
    protected $fillable = ['title', 'url', 'environments'];
    protected $attributes = [
        'title' => '',
        'url' => '',
        'environments' => '[]'
    ];

    public function monitor()
    {
        return $this->hasOne('Spatie\UptimeMonitor\Models\Monitor', 'url', 'url');
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Technology', 'props_technologies', 'prop_id', 'technology_id');
    }

    public function org()
    {
        return $this->belongsTo('App\Org');
    }
}