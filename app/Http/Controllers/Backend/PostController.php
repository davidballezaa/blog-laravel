<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->orderBy('id')->get();

        return view('posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all());

        if($request->file('image')){
            $post->image = $request->file('image')->store('posts', 'public');
            $post->save();
        }

        return redirect('/posts')->with('status', 'Created succesfully');
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != auth()->user()->id){
            return redirect('/posts')->with('status', 'No tienes permiso de modificar un post que no es tuyo');
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'iframe' => $request->iframe
        ]);

        if($request->file('image')){
            Storage::disk('public')->delete($post->image);
            $post->image = $request->file('image')->store('posts', 'public');
            $post->save();
        }

        return redirect('/posts')->with('status', 'Updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete();

        return back()->with('status', 'Deleted succesfully');
    }
}
