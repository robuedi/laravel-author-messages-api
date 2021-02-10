<?php

namespace App\Http\Resources\v2;

use App\Http\Resources\AuthorCollectionResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource implements AuthorCollectionResourceInterface
{
    private $requested_fields = [];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->when($this->checkField('id'), $this->id),
            'name' => $this->when($this->checkField('name'), $this->name),
            'created_at' => $this->when($this->checkField('created_at'), $this->created_at),
            'updated_at' => $this->when($this->checkField('updated_at'), $this->updated_at),
            'messages' => $this->when(request()->has('has_messages'), AuthorMessageResource::collection($this->whenLoaded('messages')))
        ];
    }

    private function checkField(string $field_name)
    {
        if(!request()->has('fields'))
        {
            return true;
        }

        return in_array($field_name, $this->getRequestedFields());
    }

    private function getRequestedFields()
    {
        if(!empty($this->requested_fields))
        {
            return $this->requested_fields;
        }

        $this->requested_fields = explode(',', request()->get('fields'));
        return $this->requested_fields;
    }

}
