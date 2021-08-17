<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;



class AuthorController extends Controller
{
    public function index()
    {
        // get current logged in user
        $user = Auth::user();

        $authors = Author::get();
        return view('admin.authors.index', compact('authors'));
    }

    
    public function show(Author $author)
    {
        return view('blog.layouts.post', compact('author'));
    }


    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        //permission post policy with authorize user_id to create
        $this->authorize('create', Author::class);
        return view('admin.authors.create');
    }


    public function store(Request $request)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'author'        =>'required|max:20',
            'post_author'   =>'required|file|max:1000',
            'about_author'  =>'required',
            'introduction'  =>'required|min:5|max:200',
            'email'         =>'required|email',
            'nationality'   =>'required',
            'motivation'    =>'required|min:5|max:200'
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file       = $request->file('post_author');
        $fileName   = time(). "." .$file->getClientOriginalName();

        //is dengan nama folder tempat kemana file diupload
        $destinationPath    = 'storage/images/author';
        $file->move($destinationPath,$fileName);

        Author::create([
            'user_id'       => auth()->user()->id,
            'author'        => $request->author,
            'post_author'   => $fileName,
            'about_author'  => $request->about_author,
            'introduction'  => $request->introduction,
            'email'         => $request->email,
            'nationality'   => $request->nationality,
            'motivation'    => $request->motivation,
            'slug'          => SlugService::createSlug(Author::class, 'slug', $request->author)
        ]);
        Session::flash('message-created', 'Author with name '.$request['author'].' was created');
        return redirect()->route('author.index');
    }


    public function getAuthorById($slug)
    {
        // get current logged in user
        $user = Auth::user();

        $author   = Author::where('slug',$slug)->first();
        return view('admin.authors.single-author', compact('author'));
    }


    public function edit($slug)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $authors = Author::where('slug', $slug)->get();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $authors = Author::where('slug', $slug)->get();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $authors = Author::where('slug', $slug)->get();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        return view('admin.authors.edit', compact('authors'));
    }


    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'author'        =>'required|max:20',
            'post_author'   =>'required|file|max:1000',
            'about_author'  =>'required',
            'introduction'  =>'required|min:5|max:200',
            'email'         =>'required|email',
            'nationality'   =>'required',
            'motivation'    =>'required|min:5|max:200'
        ]);

        if (auth()->user()->userHasRole('Admin')) {
            $author  = Author::where('id',$id)->first();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $author  = Author::where('id',$id)->first();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $author  = Author::where('id',$id)->first();

                    //permission author policy with authorize user_id to update
                    $this->authorize('update', $author);
                    } else {
                        abort(403, 'You are not authorized');
                    }

        if(\File::exists('storage/images/author/'. $author->post_author)){
            \File::delete('storage/images/author/'.$author->post_author);
        }

        // menyimpan data file yang diupload ke variabel $file
        $file       = $request->file('post_author');
        $fileName   = time(). "." .$file->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $destinationPath    = 'storage/images/author';
        $file->move($destinationPath,$fileName);

        $author   = DB::table('authors')
                    ->where('id',$id)
                    ->update([
            'author'        => $request->author,
            'post_author'   => $fileName,
            'about_author'  => $request->about_author,
            'introduction'  => $request->introduction,
            'email'         => $request->email,
            'nationality'   => $request->nationality,
            'motivation'    => $request->motivation,
            'slug'          => SlugService::createSlug(Author::class, 'slug', $request->author)
            
        ]);
        Session::flash('message-updated', 'Author with name '.$request['author'].' was updated');
        return redirect()->route('author.index');
    }


    public function destroy($id)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $authors = Author::where('id', $id)->first();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $authors = Author::where('id', $id)->first();
                } elseif (auth()->user()->userHasRole('Author')) {
                    $authors = Author::where('id', $id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        $author = Author::where('id',$id)->first();

        //permission post policy with authorize user_id to delete
        $this->authorize('delete', $author);

        if(\File::exists('storage/images/author/'. $author->post_author)){
            \File::delete('storage/images/author/'.$author->post_author);
        }
        Author::where('id',$id)->delete();
        Session::flash('message', 'Author with name '.$author['author'].' was Deleted');
        return back();
    }
}
