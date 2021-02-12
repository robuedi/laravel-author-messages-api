<?php


namespace App\Repositories;

use App\Models\Author;
use Illuminate\Support\Facades\Log;

class AuthorRepository
{
    public function index()
    {
        $query = Author::query();

        //check if messages required
        if(request()->has('has_messages'))
        {
            $fields = $fields = explode(',', request()->get('has_messages'));
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
        if(request()->has('fields'))
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

}
