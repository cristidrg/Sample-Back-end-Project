<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prop extends Model
{ 
    public function monitor()
    {
        return $this->hasOne('Spatie\UptimeMonitor\Models\Monitor', 'url', 'url');
    }

    public function org()
    {
        return $this->belongsTo('App\Org');
    }
}