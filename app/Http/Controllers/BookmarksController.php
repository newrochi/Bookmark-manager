<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookmarks=Bookmark::where('user_id',Auth::id())->get();
        return view('home')->with('bookmarks',$bookmarks);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required'
        ]);

        $bookmark=new Bookmark();
        $bookmark->name=$request->input('name');
        $bookmark->user_id=Auth::id();
        $bookmark->url=$request->input('url');
        $bookmark->description=$request->input('description');
        $bookmark->save();
        return redirect('/home')->with('success','Bookmark Added Successfully!');
    }

    public function destroy($id)
    {
        $bookmark=Bookmark::find($id);
        $bookmark->delete();
        return;
    }
}
