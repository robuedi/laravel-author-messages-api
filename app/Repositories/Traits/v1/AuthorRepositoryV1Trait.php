<?php


namespace App\Repositories\Traits\v1;

use App\Models\Author;

trait AuthorRepositoryV1Trait
{
    public function indexV1()
    {
        return Author::query()->paginate()->appends(request()->query());
    }

}
