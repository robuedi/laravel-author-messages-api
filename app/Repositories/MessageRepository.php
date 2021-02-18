<?php


namespace App\Repositories;

use App\Models\Author;
use App\Models\Message;

class MessageRepository implements MessageRepositoryInterface
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

    public function updateExceptParent(Message $message) : Message
    {
        $message->update(request()->except('author_id'));
        return $message;
    }

    public function delete(Message $message) : Message
    {
        $message->delete();
        return $message;
    }
}
