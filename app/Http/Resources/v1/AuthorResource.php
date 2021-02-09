<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\AuthorResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource implements AuthorResourceInterface
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
