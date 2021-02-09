<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\MessageResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource implements MessageResourceInterface
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
