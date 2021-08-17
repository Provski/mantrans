<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    public function index()
    {
        // get current logged in user
        $user = Auth::user();

        $quotes = Quote::all();
        return view('admin.quotes.index', compact('quotes'));
    }


    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        //permission post policy with authorize user_id to create
        $this->authorize('create', Quote::class);

        return view('admin.quotes.create');
    }


    public function store(Request $request)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'title'         =>'required|max:35',
            'content'       =>'required|max:300',
            'name'          =>'required|max:25'
        ]);

        Quote::create([
            'user_id'       => auth()->user()->id,
            'title'         => $request->title,
            'content'       => $request->content,
            'name'          => $request->name
        ]);

        Session::flash('message-created', 'Quote with title '.$request['title'].' was created');
        return redirect()->route('quote.index');    
    }



    public function getQuoteById($id)
    {
        // get current logged in user
        $user = Auth::user();

        $quote   = Quote::where('id',$id)->first();
        return view('admin.quotes.single-quote', compact('quote'));
    }



    public function edit($id)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $quotes = Quote::where('id', $id)->get();
            } elseif (auth()->user()->userHasRole('Manager')) {
                $quotes = Quote::where('id', $id)->get();
                    } else {
                        abort(403, 'You are not authorized');
                    }
        return view('admin.quotes.edit', compact('quotes'));
    }


    public function update(Request $request, $id)
    {
        // get current logged in user
        $user = Auth::user();

        $request->validate([
            'title'         =>'required|max:35',
            'content'       =>'required|max:300',
            'name'          =>'required|max:25'
        ]);

        $quote   = Quote::where('id',$id)->first();

        //permission quote policy with authorize user_id to update
        $this->authorize('update', $quote);

        $quote   = DB::table('quotes')
                    ->where('id',$id)
                    ->update([
                'title'     => $request->title,
                'content'   => $request->content,
                'name'      => $request->name
        ]);
                        
        Session::flash('message-updated', 'Quote with title '.$request['title'].' was updated');
        return redirect()->route('quote.index');
    }


    public function destroy($id)
    {
        // get current logged in user
        $user = Auth::user();

        if (auth()->user()->userHasRole('Admin')) {
            $quote = Quote::where('id', $id)->first();
                    } else {
                        abort(403, 'You are not authorized');
                    }

        //permission quote policy with authorize user_id to update
        $this->authorize('delete', $quote);
        
        Quote::where('id',$id)->delete();
        Session::flash('message', 'Quote with title '.$quote['title'].' was Deleted');
        return back();

    }


}
