<?php

namespace App;

use App\Prop;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $table = 'technologies';
    protected $guarded = ['id'];
    protected $attributes = [
        'name' => ''
    ];

    public function props() {
        return $this->belongsToMany('App\Prop', 'props_technologies', 'technology_id', 'prop_id');
    }
}
