<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prop extends Model
{ 
    protected $casts = ['environments' => 'array'];
    protected $fillable = ['title', 'url', 'environments'];
    protected $attributes = [
        'title' => '',
        'url' => '',
        'environments' => '[]'
    ];

    // Invariant: This assumes that our root org has ID of 1
    public function getContacts(Prop $prop)
    {
        $org = $prop->org;
        
        do {
            if (isset($org->users) && count($org->users) > 0) {
                return $org->users;
            }
            
            $org = $org->parent;
        } while($org->id != 1);

        return $org->users;
    }

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