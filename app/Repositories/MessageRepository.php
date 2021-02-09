<?php


namespace App\Repositories;

use App\Models\Author;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class MessageRepository
{
    public function index(Author $author)
    {
        return $author->messages;
    }

    public function create(Author $author)
    {
        //add the author
        request()->merge([ 'author_id' => $author->id ]);

        //make the message
        return Message::create(request()->all());
    }
}
