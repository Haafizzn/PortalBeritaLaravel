<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comments;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Termwind\Components\Dd;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user()->id;
        $post = Post::where('user_id', $user)->get();

        $data = [
            'post' => $post
        ];
        return view('post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();

        $data['image'] = $request->file('image')->store('image');
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->title);
        
        Post::create($data);
        
        return redirect('post');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $data = Post::where('slug', $slug)->first();
        $comments = $data->comments()->get();
        $total_comments = $comments->count();

        return view('post.show', compact('data', 'comments', 'total_comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $new_slug = Str::slug($request['title']);

        if (empty($request->image)) {
            $post->update([
                'title'=>$request['title'],
                'content'=>$request['content'],
                'slug'=>$new_slug,
            ]);
            return redirect("post/$new_slug/show");
            # code...
        } else {
            Storage::delete($post->image);
            $post->update([
                'title'=>$request['title'],
                'content'=>$request['content'],
                'slug'=>$new_slug,
                'image'=>$request->file('image')->store('image')
            ]);
            return redirect("post/$new_slug");
            # code...
        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $slug)
    {
        $data = $post->where('slug', $slug)->first();
        $data->delete();
        return redirect('post');
    }
}
