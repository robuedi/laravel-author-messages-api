<?php


namespace App\Repositories;

use App\Models\Author;
use Illuminate\Support\Facades\Log;

class AuthorRepository
{
    public function index()
    {
        $query = Author::query();

        return $query->paginate()->appends(request()->query());
    }

    public function create()
    {
        return Author::create(request()->all());
    }

}
