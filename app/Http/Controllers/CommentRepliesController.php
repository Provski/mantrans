<?php

namespace App\Http\Controllers;

use App\Notifications\ReplyToComment;
use App\Models\Post;
use App\Models\User;
use App\Models\CommentReplies;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        
        if (!($user->userHasRole('Admin') || 
                $user->userHasRole('Manager') || 
                    $user->userHasRole('Author') || 
                        $user->userHasRole('Subscriber') || 
                            $user->userHasRole('User'))) {
                        abort(403, 'You are not authorized');
            }
            $commentreplies = CommentReplies::orderBy('created_at', 'desc');

            // if ($user->userHasRole('Subscriber') || $user->userHasRole('User')) {
            //         $commentreplies->where('user_id', $user->id);
            // }
            $commentreplies = $commentreplies->get();

        $comments         = Comment::orderBy('created_at','desc')->get();
        // dd($commentreplies);
        return view('admin.comments.replies.index', compact('commentreplies','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReply(Request $request, Comment $comment, Commentreplies $reply)
    {
        // return $request->all();
        $user       = Auth::user();
        $comment    = Comment::findOrFail($request->comment_id);

        if (auth()->user()) {
            $request->request->add(['user_id'=>auth()->user()->id]);
            } else {
                    abort(401, 'You required to login');
            }
        $commentreplies   = CommentReplies::create($request->all());
        // dd($request->all());
        if ($comment->user_id != $commentreplies->user_id) {
            $user   = User::find($comment->user_id);
            $user->notify(new ReplyToComment($commentreplies));
        }
        Session::flash('message-updated','Replies waiting for moderation');
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $post            = Post::findOrFail($id);
    //     $commentreplies  = $post->comment;

    //     return view('comment.index', compact('comments'));
    // }


    public function getReplyById($id)
    {
        // get current logged in user
        $user = Auth::user();

        $commentreply   = CommentReplies::where('id',$id)->first();
        return view('admin.comments.replies.single-reply', compact('commentreply'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $commentreplies = DB::table('comment_replies')
                        ->where('id', $id)
                        ->update($request->except(['_token','_method']));
        Session::flash('message-updated', 'Replies was moderated');
        return redirect()->route('reply.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $commentreply = CommentReplies::where('id', $id)->first();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $commentreply = CommentReplies::where('id', $id)->first();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $commentreply = CommentReplies::where('id', $id)->first();

                    //permission comment policy with authorize auth() user_id to delete
                    $this->authorize('delete', $post);
                    } else {
                        abort(403, 'You are not authorized');
                    }

        CommentReplies::where('id',$id)->delete();
        Session::flash('message', 'Reply was Deleted');

        return redirect()->back();
    }
}
