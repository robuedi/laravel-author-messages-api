<?php


namespace App\Repositories;

use App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function index()
    {
        return Author::query()->paginate()->appends(request()->query());
    }

    public function indexV2()
    {
        $query = Author::query();

        //check if messages required
        if(request()->has('has_messages'))
        {
            $fields = array_filter(explode(',', request()->get('has_messages')));
            if($fields)
            {
                $query->with(['messages' => function($query) use ($fields){
                    $query->select(array_merge($fields, ['author_id']));
                }]);
            }
            else
            {
                $query->with('messages');
            }
        }

        //check requested fields
        if(request()->get('fields'))
        {
            $select = request()->get('has_messages') ? 'id,'.request()->get('fields') : request()->get('fields');
            $query->select(explode(',', $select));
        }

        return $query->paginate()->appends(request()->query());
    }

    public function create()
    {
        return Author::create(request()->all());
    }

    public function update(Author $author) : Author
    {
        $author->update(request()->all());
        return $author;
    }

    public function delete(Author $author) : Author
    {
        $author->delete();
        return $author;
    }

}
