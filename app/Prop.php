<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Prop extends Model
{
    use NodeTrait;

    
    public function monitor()
    {
        return $this->hasOne('Spatie\UptimeMonitor\Models\Monitor', 'url', 'url');
    }
}

Prop::fixTree();

/*
$prop = new App\Prop;
$prop->monitor()->save($monitor);
*/