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

    public function getPropCount(Org $org) {
        $a11ySum = 0;

        foreach ($org->props as $prop) {
            $a11ySum = $a11ySum + 1;
        }

        foreach ($org->children as $childOrg) {
            $a11ySum = $a11ySum + $this->getScore($childOrg);
        }

        return $a11ySum;
    }

    public function hasDownProps(Org $org) {
        $downProps = false;

        foreach ($org->props as $prop) {
            if ($prop->monitor->uptime_status == 'down') {
                return true;
            }
        }

        foreach ($org->children as $childOrg) {
            $downProps = $downProps || $this->hasDownProps($childOrg);
        }

        return $downProps;
    }

    public function getScore(Org $org) {
        $a11ySum = 0;

        foreach ($org->props as $prop) {
            $a11ySum = $a11ySum + $prop->a11yScore;
        }

        foreach ($org->children as $childOrg) {
            $a11ySum = $a11ySum + $this->getScore($childOrg);
        }

        return $a11ySum;
    }


    public function getA11yScore()
    {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 1;
        }

        return $this->getScore($this) / $propCount;
    }
}

Org::fixTree();

