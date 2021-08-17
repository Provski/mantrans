<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\CommentReplies;
use App\Models\Author;
use App\Models\Category;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts          = Post::orderBy('created_at','desc')->simplePaginate(3);
        $authors        = Author::get();
        $categories     = Category::get();
        $count          = DB::table('posts')->select('category_id', DB::raw('count(category_id) as total'))->groupBy('category_id')->get();
        $quotes         = Quote::get()->random(1);

        $comments       = Comment::where('is_active',1)->get();
        $commentreplies = CommentReplies::where('is_active',1)->get();

        $commentscount  = $comments->count();
        $repliescount   = $commentreplies->count();
        $totalcomments  = $commentscount + $repliescount;

        return view('blog.show', compact('posts','authors','categories','count','quotes','totalcomments'));
    }

    public function adminDashboard()
    {
        // get current logged in user
        $user = Auth::user();
        
        $posts          = Post::get();
        $authors        = Author::get();
        $categories     = Category::get();
        $quotes         = Quote::get();
        return redirect()->route('blog.admin.chart');
    }


    public function chartDashboard()
    {
        // get current logged in user
        $user = Auth::user();

        $comment             = Comment::first();
        $postsCount          = Post::count();
        $authorsCount        = Author::count();
        $categoriesCount     = Category::count();
        $quotesCount         = Quote::count();
        return view('admin.charts.index', compact('postsCount','authorsCount','categoriesCount','quotesCount','comment'));
    }


    public function show($id, $slug)
    {
        $posts          = Post::where('slug',$slug)->get();
        $like           = Like::where('post_id', $id)->count();
        $comments       = Comment::orderBy('created_at','desc')->where('parent_id',0)->get();
        $commentreplies = CommentReplies::orderBy('created_at','desc')->where('is_active',1)->get();

        $commentscount  = $comments->count();
        $repliescount   = $commentreplies->count();
        $totalcomments  = $commentscount + $repliescount;
        return view('blog.layouts.post', compact('posts','comments','commentreplies','totalcomments','like'));
    }


    public function aboutAuthor($slug)
    {
        $authors   = Author::where('slug',$slug)->get();
        $quotes    = Quote::get()->random(1);
        return view('blog.about-author', compact('authors','quotes'));
    }


    public function category($slug)
    {
        $categories     = Category::where('slug',$slug)->get();
        $authors        = Author::get()->random(1);
        $quotes         = Quote::get()->random(1);
        return view('blog.category', compact('categories','authors','quotes'));
    }
}
