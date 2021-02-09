<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\MessageCollectionResourceInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageCollectionResource extends ResourceCollection implements MessageCollectionResourceInterface
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
