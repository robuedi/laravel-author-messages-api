<?php

namespace App\Http\Resources\v2;

use App\Http\Resources\CheckFields;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorMessageResource extends JsonResource
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
        if(request()->has('has_messages'))
        {
            $this->setParamName('has_messages');

            return [
                'id'        => $this->when($this->checkField('id'), $this->id),
                'author_id' => $this->when($this->checkField('author_id'), $this->author_id),
                'body'      => $this->when($this->checkField('body'), $this->body),
                'created_at' => $this->when($this->checkField('created_at'), $this->created_at),
                'updated_at' => $this->when($this->checkField('updated_at'), $this->updated_at)
            ];
        }

        return parent::toArray($request);
    }

}
