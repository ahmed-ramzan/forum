<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create','store']);
    }

    public function index()
    {
        $discussions = Discussion::paginate(5);
        return view('discussions.index',compact('discussions'));
    }


    public function create()
    {
        return view('discussions.create');
    }


    public function store(Request $request)
    {
        $this->validatedData();
        Discussion::create([
            'user_id' => Auth::id(),
            'channel_id' => $request->channel,
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title)
        ]);
        return redirect(route('discussions.index'))->with('success','Discussion created successfully');
    }


    public function show(Discussion $discussion)
    {
        return view('discussions.show',compact('discussion'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function validatedData()
    {
        return $validatedData = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'channel' => 'required',
        ]);
    }

    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);
        return redirect()->back()->with('success','Mark as best reply');
    }
}
