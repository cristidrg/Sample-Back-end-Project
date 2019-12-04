<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Org extends Model
{
    use NodeTrait;

    protected $guarded = ['id'];
    protected $attributes = [
        'title' => '',
    ];

    public function props()
    {
        return $this->hasMany('App\Prop');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'orgs_users', 'org_id', 'user_id');
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

    public function getA11yScoreHelper(Org $org) {
        $a11ySum = 0;

        foreach ($org->props as $prop) {
            $a11ySum = $a11ySum + $prop->a11yScore;
        }

        foreach ($org->children as $childOrg) {
            $a11ySum = $a11ySum + $this->getA11yScoreHelper($childOrg);
        }

        return $a11ySum;
    }

    public function getA11yScore() {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 1;
        }

        return intval($this->getA11yScoreHelper($this) / $propCount * 100) / 100;
    }

    public function getPerfScoreHelper(Org $org) {
        $perfSum = 0;

        foreach ($org->props as $prop) {
            $perfSum = $perfSum + $prop->perfScore;
        }

        foreach ($org->children as $childOrg) {
            $perfSum = $perfSum + $this->getPerfScoreHelper($childOrg);
        }

        return $perfSum;
    }

    public function getPerfScore() {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 1;
        }

        return intval($this->getPerfScoreHelper($this) / $propCount * 100) / 100;
    }

    public function getSeoScoreHelper(Org $org) {
        $seoSum = 0;

        foreach ($org->props as $prop) {
            $seoSum = $seoSum + $prop->seoScore;
        }

        foreach ($org->children as $childOrg) {
            $seoSum = $seoSum + $this->getSeoScoreHelper($childOrg);
        }

        return $seoSum;
    }

    public function getSeoScore() {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 1;
        }

        return intval($this->getSeoScoreHelper($this) / $propCount * 100) / 100;
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

    public function getUptimeScore()
    {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 1;
        }

        return $this->getUptimeCount($this) / $propCount;
    }
}