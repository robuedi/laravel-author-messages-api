<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\AuthorResourceInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorCollectionResource extends ResourceCollection implements AuthorResourceInterface
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
