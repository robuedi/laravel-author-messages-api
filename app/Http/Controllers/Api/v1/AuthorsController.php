<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\AuthorStoreRequest;
use App\Http\Requests\v1\AuthorUpdateRequest;
use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Http\Response;

class AuthorsController extends Controller
{
    private $author_repository;

    public function __construct(AuthorRepositoryInterface $author_repository)
    {
        $this->author_repository = $author_repository;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/authors",
     *      operationId="index",
     *      tags={"Authors"},
     *      summary="Get/Paginate the list of authors",
     *      description="Get/Paginate the list of authors",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       security={}
     *     )
     *
     * Returns list of authors
     */
    public function index()
    {
        return app()->make('AuthorCollectionResource', [$this->author_repository->index(), Response::HTTP_OK]);
    }

    /**
     * @OA\POST(
     *      path="/api/v1/authors",
     *      operationId="store",
     *      tags={"Authors"},
     *      summary="Create a new author",
     *      description="Creates a new author",
     *     @OA\Parameter(
     *          name="name",
     *          description="Author name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="successful operation, author created"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="unsuccessful operation, missing fields value"
     *       ),
     *       security={}
     *     )
     *
     * Create a new author
     */
    public function store(AuthorStoreRequest $request)
    {
        return app()->make('AuthorResource', [$this->author_repository->create(), Response::HTTP_CREATED]);
    }

    /**
     * @OA\GET(
     *      path="/api/v1/authors/{author}",
     *      operationId="show",
     *      tags={"Authors"},
     *      summary="Get author's info",
     *      description="Returns a single author's info",
     *     @OA\Parameter(
     *          name="author",
     *          description="Author's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation, author's info returned"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="author not found"
     *       ),
     *       security={}
     *     )
     *
     * Shows author
     */
    public function show(Author $author)
    {
        return app()->make('AuthorResource', [$author, Response::HTTP_OK]);
    }

    /**
     * @OA\PUT(
     *      path="/api/v1/authors/{author}",
     *      operationId="update",
     *      tags={"Authors"},
     *      summary="Update the author",
     *      description="Updates the author",
     *     @OA\Parameter(
     *          name="author",
     *          description="Author's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="name",
     *          description="Author's name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="successful operation, author updated"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="unsuccessful operation, missing fields value"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="successful operation, author not found"
     *       ),
     *       security={}
     *     )
     *
     * Updates author
     */
    public function update(AuthorUpdateRequest $request, Author $author)
    {
        return app()->make('AuthorResource', [$this->author_repository->update($author), Response::HTTP_ACCEPTED]);
    }

    /**
     * @OA\DELETE(
     *      path="/api/v1/authors/{author}",
     *      operationId="delete",
     *      tags={"Authors"},
     *      summary="Delete the author",
     *      description="Deletes the author",
     *     @OA\Parameter(
     *          name="author",
     *          description="Author's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation, author deleted"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="successful operation, author not found"
     *       ),
     *       security={}
     *     )
     *
     * Deletes author
     */
    public function destroy(Author $author)
    {
        return app()->make('AuthorResource', [$this->author_repository->delete($author), Response::HTTP_OK]);
    }
}
