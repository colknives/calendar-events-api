<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'event_name' => $this->event_name,
            'from' => $this->from,
            'to' => $this->to,
            'specific_days' => $this->specific_days,
            'month' => $this->month
        ];
    }
}
