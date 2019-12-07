<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrgResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'props' => array_column($this->props->toArray(), 'id'),
            'a11yScore' => $this->getScore('a11yScore'),
            'perfScore' => $this->getScore('perfScore'),
            'seoScore' => $this->getScore('seoScore')  
        ];
    }
}
