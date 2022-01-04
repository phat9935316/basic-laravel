<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('B2.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post)
    {
        $post->store($request);
        return redirect()->route('b2')->with([
            'alert-type' => 'success',
            'message' => __('Create post successfully')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Post $post)
    {
        return view('B2.view', ['post' => $post::with('comments')->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Post $post)
    {
        return view('B2.edit', ['post' => $post::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, $id)
    {
        $post->updatePost($request, $id);
        return redirect()->route('b2')->with([
            'alert-type' => 'success',
            'message' => __('Update post successfully')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Post $post)
    {
        $post->find($id)->delete();
        $result = [
            'success' => true,
            'message' =>  __('Delete post successfully')
        ];
        return response()->json($result);
    }

    public function comment(Request $request, Comment $comment, $id)
    {
        $comment->store($request, $id);
        $result = [
            'message' =>  __('Comment successfully')
        ];
        return response()->json($result);
    }
}
