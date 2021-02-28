<?php


namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Traits\v1\AuthorRepositoryV1Trait;
use App\Repositories\Traits\v1\AuthorRepositoryV2Trait;

/**
 * Class AuthorRepository - Using repository class as later we could switch to MongoDB/ElasticSearch...
 * @package App\Repositories
 */
class AuthorRepository implements AuthorRepositoryInterface
{
    use AuthorRepositoryV1Trait, AuthorRepositoryV2Trait;

    public function index(string $version)
    {
        switch ($version)
        {
            case 'v1':
                return $this->indexV1();
            case 'v2':
                return $this->indexV2();
        }
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
