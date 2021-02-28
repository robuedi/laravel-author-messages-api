<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\AuthorResource;
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
     *      path="/api/v2/authors",
     *      operationId="index2",
     *      tags={"Authors"},
     *      summary="Get/Paginate the list of authors - more granular + messages",
     *      description="Get/Paginate the list of authors",
     *     @OA\Parameter(
     *          name="fields",
     *          description="the list of fields to be included (comma separated)",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="has_messages",
     *          description="if to include messages, optionally specify the list of the fields (comma separated)",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       security={}
     *     )
     *
     * Returns list of projects
     */
    public function index()
    {
        return AuthorResource::collection($this->author_repository->index('v2'))->response()->setStatusCode(Response::HTTP_OK);
    }
}
