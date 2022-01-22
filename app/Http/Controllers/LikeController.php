<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function likeit(Reply $reply)
    {
        $reply->likes()->create([
            'user_id' => auth()->id()
        ]);

        broadcast(new LikeEvent($reply->id,1))->toOthers();
    }

    public function unlikeit(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->id())->first()->delete();

        broadcast(new LikeEvent($reply->id,0))->toOthers();
    }
}
