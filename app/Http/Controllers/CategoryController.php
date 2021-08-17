<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class CategoryController extends Controller
{
    public function index()
    {
        // get current logged in user
        $user = Auth::user();

        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        //permission category policy with authorize user_id to create
        $this->authorize('create', Category::class);
        return view('admin.categories.create');
    }

    
    public function store(Request $request)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'category'      =>'required|max:25',
            'post_category' =>'required|file|max:1000',
            'about_category'=>'required'
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file       = $request->file('post_category');
        $fileName   = time(). "." .$file->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $destinationPath    = 'storage/images/category';
        $file->move($destinationPath,$fileName);

        Category::create([
            'user_id'       => auth()->user()->id,
            'category'      => $request->category,
            'post_category' => $fileName,
            'about_category'=> $request->about_category,
            'slug'          => SlugService::createSlug(Category::class, 'slug', $request->category)
        ]);
        Session::flash('message-created', 'Category with name '.$request['category'].' was created');
        return redirect()->route('category.index');    
    }


    public function getCategoryById($slug)
    {
        // get current logged in user
        $user = Auth::user();

        $category   = Category::where('slug',$slug)->first();
        return view('admin.categories.single-category', compact('category'));
    }


    public function edit($slug)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $categories = Category::where('slug', $slug)->get();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $categories = Category::where('slug', $slug)->get();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        return view('admin.categories.edit', compact('categories'));
    }


    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'category'      =>'required|max:25',
            'post_category' =>'required|file|max:1000',
            'about_category'=>'required'
        ]);

        if (auth()->user()->userHasRole('Admin')) {
            $category = Category::where('id', $id)->first();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $category = Category::where('id', $id)->first();

                    //permission post policy with authorize user_id to update
                    $this->authorize('update', $category);
                    } else {
                        abort(403, 'You are not authorized');
                    }
        
        if(\File::exists('storage/images/category/'. $category->post_category)){
            \File::delete('storage/images/category/'.$category->post_category);
        }

        //menyimpan data file yang diupload ke variabel $file
        $file       = $request->file('post_category');
        $fileName   = time(). "." .$file->getClientOriginalName();

        //isi dengan nama folder tempat kemana file diupload
        $destinationPath    = 'storage/images/category';
        $file->move($destinationPath,$fileName);


        $category     = DB::table('categories')
                        ->where('id',$id)
                        ->update([
                'category'      => $request->category,
                'post_category' => $fileName,
                'about_category'=> $request->about_category,
                'slug'          => SlugService::createSlug(Category::class, 'slug', $request->category)
        ]);

        Session::flash('message-updated', 'Category with name '.$request['category'].' was updated');
        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $category = Category::where('id', $id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }

        //permission post policy with authorize user_id to update
        $this->authorize('delete', $category);

        if(\File::exists('storage/images/category/'. $category->post_category)){
            \File::delete('storage/images/category/'.$category->post_category);
        }
        Category::where('id',$id)->delete();
        Session::flash('message', 'Category with name '.$category['category'].' was Deleted');
        return back();

    }

}
