<?php

namespace App\Http\Controllers;

use App\Events\DeleteReplyEvent;
use App\Models\Reply;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Resources\ReplyResource;
use App\Notifications\newReply;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {   
        return ReplyResource::collection($question->reply);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question,Request $request)
    {
        $reply = $question->reply()->create($request->all());
        $user = $question->user;
        if($reply->user_id !== $question->user_id){
            $user->notify(new newReply($reply));
        }
        return response(['reply' => new ReplyResource($reply)],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question,Reply $reply)
    {
        return $reply;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,Request $request, Reply $reply)
    {
        $reply->update($request->all());
        return response('Updated',Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response('Deleted',Response::HTTP_OK);
    }
}
