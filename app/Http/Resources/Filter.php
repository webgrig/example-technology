<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class Filter extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Reqest $request)
    {
        return [
            'id' => $this->id,
            'title' => $this->company_title,
            'email' => $this->company_email,
            'phone' => $this->company_phone,
        ];
    }
}
