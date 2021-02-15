<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCollectionResourceInterface;
use App\Http\Resources\AuthorResourceInterface;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    private $author_repository;

    public function __construct(AuthorRepository $author_repository)
    {
        $this->author_repository = $author_repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return app()->make(AuthorCollectionResourceInterface::class, [$this->author_repository->index()]);
    }
}