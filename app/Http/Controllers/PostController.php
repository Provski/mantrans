<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function index()
    {
        // get current logged in user
        $user = Auth::user();

        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }


    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        //permission post policy with authorize user_id to create
        $this->authorize('create', Post::class);
    
        $authors = Author::all();
        $categories = Category::all();
        $posts  = Post::all();
        $quotes  = Quote::all();
        return view('admin.posts.create', compact('posts','authors','categories','quotes'));
    }


    public function store(Request $request)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'title'         => 'required|min:5|max:100',
            'post_image'    => 'required|image|max:700|dimensions:min_width=600,max_width=1920,min_height=400,max_height=1280|mimes:jpg,png,jpeg',
            'body'          => 'required',
            'figure'        => 'required|image|max:700|dimensions:min_width=600,max_width=1920,min_height=400,max_height=1280|mimes:jpg,png,jpeg',
            'figure_caption'=> 'required|min:5|max:100',
            'category_id'   => 'required',
            'author_id'     => 'required'
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file       = $request->file('post_image');
        $fileName   = time(). "." .$file->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $destinationPath    = 'storage/images/post';
        $file->move($destinationPath,$fileName);

        // menyimpan data file yang diupload ke variabel $figure
        $figure       = $request->file('figure');
        $fileFigure   = time(). "." .$figure->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $figurePath    = 'storage/images/figure';
        $figure->move($figurePath,$fileFigure);
        
        Post::create([
            'user_id'       => auth()->user()->id,
            'quote_id'      => auth()->user()->id,
            'title'         => $request->title,
            'post_image'    => $fileName,
            'body'          => $request->body,
            'figure'        => $fileFigure,
            'figure_caption'=> $request->figure_caption,
            'author_id'     => $request->author_id,
            'category_id'   => $request->category_id,
        ]);
        Session::flash('message-created', 'Post with title '.$request['title'].' was created');
        return redirect()->route('post.index');
    }
    

    public function getPostById($slug)
    {
        // get current logged in user
        $user   = Auth::user();
        $post   = Post::where('slug',$slug)->first();
        return view('admin.posts.single-post', compact('post'));
    }

    
    public function edit($slug)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $posts = Post::where('slug', $slug)->get();
            $authors = Author::all();
            $categories = Category::all();
            $quotes = Quote::all();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $posts = Post::where('slug', $slug)->get();
                $authors = Author::all();
                $categories = Category::all();
                 $quotes = Quote::all();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $posts = Post::where('slug', $slug)->get();
                    $authors = Author::all();
                    $categories = Category::all();
                    $quotes = Quote::all();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        return view('admin.posts.edit', compact('posts','authors','categories','quotes'));
    }

    
    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'title'         => 'required|min:5|max:100',
            'post_image'    => 'required|image|max:700|dimensions:min_width=600,max_width=1920,min_height=400,max_height=1280|mimes:jpg,png,jpeg',
            'body'          => 'required',
            'figure'        => 'required|image|max:700|dimensions:min_width=600,max_width=1920,min_height=400,max_height=1280|mimes:jpg,png,jpeg',
            'figure_caption'=> 'required|min:5|max:100',
            'category_id'   => 'required',
            'author_id'     => 'required'
        ]);
        
        if (auth()->user()->userHasRole('Admin')) {
            $post = Post::where('id', $id)->first();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $post = Post::where('id', $id)->first();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $post = Post::where('id', $id)->first();

                    //permission post policy with authorize user_id to update
                    $this->authorize('update', $post);
                    } else {
                        abort(403, 'You are not authorized');
                    }

        if(\File::exists('storage/images/post/'. $post->post_image)){
            \File::delete('storage/images/post/'.$post->post_image);
        }
        if(\File::exists('storage/images/figure/'. $post->figure)){
            \File::delete('storage/images/figure/'.$post->figure);
        }
        
        // menyimpan data file yang diupload ke variabel $file
        $file       = $request->file('post_image');
        $fileName   = time(). "." .$file->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $destinationPath    = 'storage/images/post';
        $file->move($destinationPath,$fileName);

        //menyimpan data file yang diupload ke variabel $figure
        $figure       = $request->file('figure');
        $fileFigure   = time(). "." .$figure->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $figurePath    = 'storage/images/figure';
        $figure->move($figurePath,$fileFigure);

        $post   = DB::table('posts')
                    ->where('id',$id)
                    ->update([
            
            'title'         => $request->title,
            'post_image'    => $fileName,
            'body'          => $request->body,
            'figure'        => $fileFigure,
            'figure_caption'=> $request->figure_caption,
            'author_id'     => $request->author_id,
            'category_id'   => $request->category_id
        ]);
        Session::flash('message-updated', 'Post with title '.$request['title'].' was updated');
        return redirect()->route('post.index');
    }

    
    public function destroy($id)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $post = Post::where('id', $id)->first();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $post = Post::where('id', $id)->first();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $post = Post::where('id', $id)->first();

                    //permission post policy with authorize auth() user_id to delete
                    $this->authorize('delete', $post);
                    } else {
                        abort(403, 'You are not authorized');
                    }

        if(\File::exists('storage/images/post/'. $post->post_image)){
            \File::delete('storage/images/post/'.$post->post_image);
        }
        if(\File::exists('storage/images/figure/'. $post->figure)){
            \File::delete('storage/images/figure/'.$post->figure);
        }
        Post::where('id',$id)->delete();
        Session::flash('message', 'Article was Deleted');
        return back();
    }
}
