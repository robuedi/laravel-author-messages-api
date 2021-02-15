<?php

namespace App\Http\Resources\v2;

use App\Http\Resources\CheckFields;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    use CheckFields;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->setParamName('fields');

        return [
            'id' => $this->when($this->checkField('id'), $this->id),
            'name' => $this->when($this->checkField('name'), $this->name),
            'created_at' => $this->when($this->checkField('created_at'), $this->created_at),
            'updated_at' => $this->when($this->checkField('updated_at'), $this->updated_at),
            'messages' => $this->when(request()->has('has_messages'), AuthorMessageResource::collection($this->whenLoaded('messages')))
        ];
    }
}
