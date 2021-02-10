<?php

namespace App\Http\Resources\v2;

use App\Http\Resources\MessageResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorMessageResource extends JsonResource implements MessageResourceInterface
{
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
            $has_messages_fields = explode(',', request()->get('has_messages'));

            return [
                'id'        => $this->when(in_array('id', $has_messages_fields), $this->id),
                'author_id' => $this->when(in_array('author_id', $has_messages_fields), $this->author_id),
                'body'      => $this->when(in_array('body', $has_messages_fields), $this->body),
                'created_at' => $this->when(in_array('created_at', $has_messages_fields), $this->created_at),
                'updated_at' => $this->when(in_array('updated_at', $has_messages_fields), $this->updated_at)
            ];
        }

        return parent::toArray($request);
    }
}
