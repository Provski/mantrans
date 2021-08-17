<?php

namespace App\Http\Controllers;

use App\Notifications\CommentToPost;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;



class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post, Comment $comments,User $id)
    {
        $user = auth()->user();
        
        if (!($user->userHasRole('Admin') || 
                $user->userHasRole('Manager') || 
                    $user->userHasRole('Author') || 
                        $user->userHasRole('Subscriber') || 
                            $user->userHasRole('User'))) {
                        abort(403, 'You are not authorized');
            }
        $comments   = Comment::orderBy('created_at','desc');

        // if ($user->userHasRole('Subscriber') || $user->userHasRole('User')) {
        //     $comments->where('user_id', $user->id);
        //     }
        $comments = $comments->get();
        return view('admin.comments.index', compact('comments'));
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
    public function store(Request $request, Post $post, Comment $comment)
    {
        // return $request->all();
        $user   = Auth::user();
        $post   = Post::findOrFail($request->post_id);

        if (auth()->user()) {
            $request->request->add(['user_id'=>auth()->user()->id]);
            } else {
                    abort(401, 'You required to login');
            }
        $comment   = Comment::create($request->all());
        // dd($request->all());
        if ($post->user_id != $comment->user_id) {
            $user   = User::find($post->user_id);
            $user->notify(new CommentToPost($comment));
        }
        Session::flash('message-created','Comment waiting for moderation');
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
    //     $post       = Post::findOrFail($id);
    //     $comments   = $post->comment;

    //     return view('comment.index', compact('comments'));
    // }


    public function getCommentById($id)
    {
        // get current logged in user
        $user = Auth::user();

        $comment   = Comment::where('id',$id)->first();
        return view('admin.comments.single-comment', compact('comment'));
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

        $comments   = DB::table('comments')
                        ->where('id', $id)
                        ->update($request->except(['_token','_method']));

        Session::flash('message-updated', 'Comment was moderated');
        // dd($comment);
        return redirect()->route('comment.index');
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
            $comment = Comment::where('id', $id)->first();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $comment = Comment::where('id', $id)->first();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $comment = Comment::where('id', $id)->first();

                    //permission comment policy with authorize auth() user_id to delete
                    $this->authorize('delete', $comment);
                    } else {
                        abort(403, 'You are not authorized');
                    }

        Comment::where('id',$id)->delete();
        Session::flash('message', 'Comment was Deleted');

        return redirect()->back();
    }
}
