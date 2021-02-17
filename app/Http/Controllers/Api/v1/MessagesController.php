<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\MessageStoreRequest;
use App\Http\Resources\MessageCollectionResourceInterface;
use App\Http\Resources\MessageResourceInterface;
use App\Models\Author;
use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessagesController extends Controller
{
    private $message_repository;

    public function __construct(MessageRepository $message_repository)
    {
        $this->message_repository = $message_repository;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/authors/{author}/messages",
     *      operationId="index_messages",
     *      tags={"Messages"},
     *      summary="Get/Paginate the list of messages from an author",
     *      description="Get/Paginate the list of messages from an author",
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
     *          description="successful operation"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="unsuccessful operation, author not found"
     *       ),
     *       security={}
     *     )
     *
     * Returns list of message
     */
    public function index(Author $author)
    {
        return app()->make('MessageCollectionResource', [$this->message_repository->index($author), Response::HTTP_OK]);
    }

    /**
     * @OA\POST(
     *      path="/api/v1/authors/{author}/messages",
     *      operationId="store_message",
     *      tags={"Messages"},
     *      summary="Create a new message for the author",
     *      description="Create a new message for the author",
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
     *          name="body",
     *          description="Message's content/body",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="successful operation, message created"
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="unsuccessful operation, missing fields value"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="unsuccessful operation, author not found"
     *       ),
     *       security={}
     *     )
     *
     * Create a new message
     */
    public function store(MessageStoreRequest $request, Author $author)
    {
        return app()->make('MessageResource', [$this->message_repository->create($author), Response::HTTP_CREATED]);
    }

    /**
     * @OA\GET(
     *      path="/api/v1/authors/{author}/messages/{message}",
     *      operationId="show_message",
     *      tags={"Messages"},
     *      summary="Get single message author's info",
     *      description="Get single message author's info",
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
     *          name="message",
     *          description="message's id",
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
     * Shows message
     */
    public function show(Author $author, Message $message)
    {
        return app()->make('MessageResource', [$message, Response::HTTP_OK]);
    }

    /**
     * @OA\PUT(
     *      path="/api/v1/authors/{author}/messages/{message}",
     *      operationId="update",
     *      tags={"Messages"},
     *      summary="Update author's message",
     *      description="Update author's message",
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
     *          name="message",
     *          description="Message's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="body",
     *          description="Messages's body",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="successful operation, message updated"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="successful operation, author/message not found"
     *       ),
     *       security={}
     *     )
     *
     * Updates message
     */
    public function update(Request $request, Author $author, Message $message)
    {
        return app()->make('MessageResource', [$this->message_repository->updateExceptParent($message), Response::HTTP_ACCEPTED]);
    }

    /**
     * @OA\DELETE(
     *      path="/api/v1/authors/{author}/messages/{message}",
     *      operationId="delete_message",
     *      tags={"Messages"},
     *      summary="Delete the author's message",
     *      description="Delete the author's message",
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
     *          name="message",
     *          description="Message's id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation, message deleted"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="successful operation, author/message not found"
     *       ),
     *       security={}
     *     )
     *
     * Deletes message
     */
    public function destroy(Author $author, Message $message)
    {
        return app()->make('MessageResource', [$this->message_repository->delete($message), Response::HTTP_OK]);
    }
}
