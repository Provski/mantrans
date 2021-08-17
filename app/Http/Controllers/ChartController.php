<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function adminDashboard()
    {
        // get current logged in user
        $user = Auth::user();
        
        $posts      = Post::all();
        $authors    = Author::all();
        $categories = Category::all();
        $quotes     = Quote::all();

        return view('blog.charts.index', compact('posts','authors','categories','quotes'));
    }
}
