<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropResource extends JsonResource
{
    public function toArray($request)
    {
        $results = array_merge(parent::toArray($request), [
            'monitor_status' => $this->monitor->uptime_status,
            'technologies' => array_column($this->technologies->toArray(), 'name'),
        ]);
        unset($results['monitor']); 

        return $results;
    }
}
