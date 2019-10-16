<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Org extends Model
{
    use NodeTrait;

    protected $fillable = ['title'];
    protected $attributes = [
        'title' => '',
        'description' => '',
    ];

    public function props()
    {
        return $this->hasMany('App\Prop');
    }

    public function getPropCount(Org $org) {
        $propCount = 0;

        foreach ($org->props as $prop) {
            $propCount = $propCount + 1;
        }

        foreach ($org->children as $childOrg) {
            $propCount = $propCount + $this->getPropCount($childOrg);
        }

        return $propCount;
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

    public function getUptimeCount(Org $org) {
        $upCount = 0;

        foreach ($org->props as $prop) {
            $value = $prop->monitor->uptime_status == 'up' ? 1 : 0;

            $upCount = $upCount + $value;
        }

        foreach ($org->children as $childOrg) {
            $upCount = $upCount + $this->getUptimeCount($childOrg);
        }

        return $upCount;
    }


    public function getA11yScore()
    {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 1;
        }

        return intval($this->getScore($this) / $propCount * 100) / 100;
    }

    public function getUptimeScore()
    {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 1;
        }

        return $this->getUptimeCount($this) / $propCount;
    }
}

Org::fixTree();