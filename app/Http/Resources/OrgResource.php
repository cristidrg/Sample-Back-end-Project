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
            'props' => array_column($this->props->toArray(), 'id2'),
            'a11yScore' => $this->getA11yScore(),
            'perfScore' => $this->getPerfScore(),
            'seoScore' => $this->getSeoScore()  
        ];
    }
}
