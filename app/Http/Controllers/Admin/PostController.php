<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\PostUpdateAdminRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('id','DESC')->get();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::orderBy('id','DESC')
        ->where('type','ARTICLES')
        ->get();

        $tags=Tag::orderBy('id','DESC')
        ->where('type','ARTICLES')
        ->get();
        
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=new Post();
        $post->user_id=auth()->user()->id;
        $post->category_id=$request->category_id;
        $post->name=$request->name;
        $post->slug=$request->slug;
        $post->excerpt=$request->excerpt;
        $post->body=$request->body;
        $post->status=$reques->status;
        if($request->file('file')){
            $image=$request->file('file')->store('articles','documents');
            $post->file=$image;
        }
        $post->save();

        $post->tags()->attach($request->tag_id);

        return redirect()->route('posts.index')->with('success','Articulo publicado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $categories=Category::orderBy('id','DESC')
        ->where('type','ARTICLES')
        ->get();

        $tags=Tag::orderBy('id','DESC')
        ->where('type','ARTICLES')
        ->get();
        return view('admin.posts.edit',compact('post','categories','tags'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateAdminRequest $request, $id)
    {
        $post=Post::findOrFail($id);
        $post->category_id=$request->category_id;
        $post->name=$request->name;
        $post->slug=$request->slug;
        $post->excerpt=$request->excerpt;
        $post->body=$request->body;
        $post->status=$request->status;
        if($request->file('file')){
            $image=$request->file('file')->store('articles','documents');
            $post->file=$image;
        }
        $post->save();

        $post->tags()->sync($request->tag_id);

        return redirect()->route('posts.index')->with('success','Articulo editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id)->delete();
        return redirect()->route('posts.index')->with('success','Articulo eliminado con exito');
    }
}
