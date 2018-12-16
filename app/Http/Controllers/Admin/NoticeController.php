<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notice;
use App\Category;
use App\Tag;
use App\Http\Requests\NoticeUpdateAdminRequest;


class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices=Notice::orderBy('id','DESC')->get();
        return view('admin.notices.index',compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $post=Notice::findOrFail($id);
        $categories=Category::orderBy('id','DESC')
        ->where('type','NOTICES')
        ->get();

        $tags=Tag::orderBy('id','DESC')
        ->where('type','NOTICES')
        ->get();

        return view('admin.notices.edit',compact('post','categories','tags'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticeUpdateAdminRequest $request, $id)
    {
        $notice=Notice::findOrFail($id);
        $notice->category_id=$request->category_id;
        $notice->name=$request->name;
        $notice->slug=$request->slug;
        $notice->excerpt=$request->excerpt;
        $notice->body=$request->body;
        $notice->status=$request->status;
        if($request->file('file')){
            $image=$request->file('file')->store('notices','documents');
            $notice->file=$image;
        }
        $notice->save();

        $notice->tags()->sync($request->tag_id);

        return redirect()->route('notices.index')->with('success','Noticia editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice=Notice::findOrFail($id)->delete();
        return redirect()->route('notices.index')->with('success','Noticia eliminada con exito');
    }
}
