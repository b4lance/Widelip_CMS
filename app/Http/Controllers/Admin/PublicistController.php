<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Publicist;
use App\User;
use App\Http\Requests\PublicistStoreRequest;  
use App\Http\Requests\PublicistUpdateRequest;  


class PublicistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicists=Publicist::orderBy('id','ASC')
        ->get();
        return view('admin.publicists.index',compact('publicists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::doesntHave('publicist')
        ->orderBy('id','username')
        ->where('status','ACTIVE')
        ->with('publicist')
        ->get();
        return view('admin.publicists.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=[
            'user_id.required'=>'El campo usuario es requerido',
            'name.required'=>'El campo nombre es requerido',
            'lastname.required'=>'El campo apellido es requerido',
            'college.required'=>'El campo universidad es requerido',
            'biography.required'=>'El campo biografia es requerido',
            'file.required'=>'El Documento es requerido',
            'status.required'=>'El campo status es requerido'
        ];

        $this->validate($request,[
            'user_id'=>'required',
            'name'=>'required',
            'lastname'=>'required',
            'college'=>'required',
            'biography'=>'required',
            'file'=>'required',
        ],$messages);

        $publicist_search=Publicist::where('user_id',$request->user_id)
        ->count();

        if($publicist_search > 0){
            return redirect()->route('publicists.create')->with('error','El usuario seleccionado ya cuenta con un perfil publicista, intenta con otro');
        }else{
        $publicist=new Publicist();
        $publicist->user_id=$request->user_id;
        $publicist->name=$request->name;
        $publicist->lastname=$request->lastname;
        $publicist->college=$request->college;
        $publicist->biography=$request->biography;
         if($request->file('file')){
            $image=$request->file('file')->store('publicist','documents');
            $publicist->file=$image;
        }
        $publicist->status=$request->status;
        $publicist->save();

        return redirect()->route('publicists.index')->with('success','Publicista guardado con exito');
        }
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
        
        $publicist=Publicist::findOrFail($id);

        return view('admin.publicists.edit',compact('publicist','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages=[
            'name.required'=>'El campo nombre es requerido',
            'lastname.required'=>'El campo apellido es requerido',
            'college.required'=>'El campo universidad es requerido',
            'biography.required'=>'El campo biografia es requerido',
        ];

        $this->validate($request,[
            'name'=>'required',
            'lastname'=>'required',
            'college'=>'required',
            'biography'=>'required',
        ],$messages);

        $publicist=Publicist::findOrFail($id);
        $publicist->name=$request->name;
        $publicist->lastname=$request->lastname;
        $publicist->college=$request->college;
        $publicist->biography=$request->biography;
         if($request->file('file')){
            $image=$request->file('file')->store('publicist','documents');
            $publicist->file=$image;
        }
        $publicist->status=$request->status;
        $publicist->save();

        return redirect()->route('publicists.index')->with('success','Publicista editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicist=Publicist::findOrFail($id)->delete();

        return redirect()->route('publicists.index')->with('success','Publicista eliminado con exito');
    }
}
