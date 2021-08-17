<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($id)
    {
        $like   = Like::where('post_id',$id)->where('user_id', auth()->user()->id)->first();

        if ($like) {
            $like->delete();
            return redirect()->back();
        } else {
            Like::create([
                'post_id'   => $id,
                'user_id'   => auth()->user()->id
            ]);
            return redirect()->back();
        }
    }
}
