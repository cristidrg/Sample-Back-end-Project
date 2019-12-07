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


    private function getAveragedScoreHelper(Org $org, String $scoreName)
    {
        $sum = 0;

        foreach ($org->props as $prop) {
            $sum = $sum + $prop->getAttribute($scoreName);
        }

        foreach ($org->children as $childOrg) {
            $sum = $sum + $this->getAveragedScoreHelper($childOrg, $scoreName);
        }

        return $sum;
    }

    // #Maintenance: You can get average scores for any number field by providing the fieldName on the prop
    public function getScore(String $scoreName)
    {
        $propCount = $this->getPropCount($this);

        if ($propCount == 0) {
            return 100;
        }

        return intval($this->getAveragedScoreHelper($this, $scoreName) / $propCount );
    }
}