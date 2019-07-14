<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Org extends Model
{
    use NodeTrait;
    

    /**
     * Get the comments for the blog post.
     */
    public function props()
    {
        return $this->hasMany('App\Prop');
    }
}

Org::fixTree();

