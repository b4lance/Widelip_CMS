<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest; 
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PublicistStoreRequest; 
use App\Http\Requests\NoticeStoreRequest; 
use App\Http\Requests\NoticeUpdateRequest; 
use App\Post;
use App\Notice;
use App\Category;
use App\Tag;
use App\Publicist;
use App\User;



class PageController extends Controller
{
    public function index(){
        $posts=Post::orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);
        $notices=Notice::orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);

        return view('web.home',compact('posts','notices'));
    }

    public function get_post(Request $request){
        $posts=Post::orderBy('id','DESC')
        ->where('status','PUBLISHED')
        ->with('category','tags','user')->paginate(5);
        
        return  [
            'pagination' => [
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'from' => $posts->firstItem(),
                'to' => $posts->lastItem()
            ],
            'posts' => $posts
        ];
    }

    public function post($slug){
        $post=Post::where('slug',$slug)->first();

        return view('web.post',compact('post'));
    }

     public function category($slug){
        $category=Category::where('slug',$slug)->pluck('id')
        ->first();
        $posts=Post::where('category_id',$category)
        ->orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);

        return view('web.posts',compact('posts'));
    }

     public function tag($slug){
       
        $posts=Post::whereHas('tags', function($query) use($slug){
            $query->where('slug',$slug);
        })
        ->orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);

        return view('web.posts',compact('posts'));
    }

    public function posts(){
        $posts=Post::orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);

        return view('web.posts',compact('posts'));
    }

     public function panel(){
        $user_id=auth()->user()->id;
        
        $posts=Post::orderBy('id','DESC')
        ->where('status','PUBLISHED')
        ->where('user_id',$user_id)->get();

        $count=Post::orderBy('id','DESC')
        ->where('status','PUBLISHED')
        ->where('user_id',$user_id)->count();

        $publicist_count=Publicist::where('status','ACTIVE')
        ->where('user_id',$user_id)->count();

        if($publicist_count > 0){

        $publicist=Publicist::where('status','ACTIVE')
        ->where('user_id',$user_id)->first();

        $count_notices=Notice::orderBy('id','DESC')
        ->where('status','PUBLISHED')
        ->where('publicist_id',$publicist->id)->count();
        
        }else{
            $count_notices=0;
        }

        return view('web.panel',compact('posts','count','count_notices'));
    }

    public function newPost(){
        $categories=Category::orderBy('id','DESC')->get();
        $tags=Tag::orderBy('id','DESC')->get();
        return view('web.new_post',compact('categories','tags'));
    }

    public function storePost(PostStoreRequest $request){
        
        $post=new Post();
        $post->user_id=auth()->user()->id;
        $post->category_id=$request->category_id;
        $post->name=$request->name;
        $post->slug=$request->slug;
        $post->excerpt=$request->excerpt;
        $post->body=$request->body;
        $post->status='DRAFT';
        if($request->file('file')){
            $image=$request->file('file')->store('articles','documents');
            $post->file=$image;
        }
        $post->save();

        $post->tags()->attach($request->tag_id);

        return redirect()->route('panel')->with('success','Articulo publicado con exito, debes esperar 24 horas habiles para que este activo en nuestra plataforma');
    }

    public function editPost($id){
        $post=Post::findOrFail($id);
        $this->authorize('pass',$post);
        $categories=Category::orderBy('id','DESC')->get();
        $tags=Tag::orderBy('id','DESC')->get();
        return view('web.update_post',compact('post','categories','tags'));    
    }

    public function updatePost(PostUpdateRequest $request, $id){
        $post=Post::findOrFail($id);
        $post->category_id=$request->category_id;
        $post->name=$request->name;
        $post->slug=$request->slug;
        $post->excerpt=$request->excerpt;
        $post->body=$request->body;
        $post->status='DRAFT';
        if($request->file('file')){
            $image=$request->file('file')->store('articles','documents');
            $post->file=$image;
        }
        $post->save();

        $post->tags()->sync($request->tag_id);

        return redirect()->route('panel')->with('success','Articulo editado con exito, estara en revisión antes de estar nuevamente activo en nuestra plataforma');
    }


    public function deletePost($id){
        $post=Post::findOrFail($id)->delete();
        $this->authorize('pass',$post);
        return redirect()->route('panel')->with('success','Arituclo eliminado con exito');
    }

    public function profile($id){
        $user=User::findOrFail($id);

        $posts=Post::where('user_id',$id)
        ->where('status','PUBLISHED')
        ->orderBy('id','DESC')
        ->paginate(5);

        $publicist=Publicist::where('status','ACTIVE')
        ->where('user_id',$user->id)
        ->count();

        if($publicist > 0){

        $publicist_name=Publicist::where('status','ACTIVE')
        ->where('user_id',$user->id)
        ->first();

        $notices=Notice::where('publicist_id',$publicist_name->id)
        ->where('status','PUBLISHED')
        ->orderBy('id','DESC')
        ->paginate(5);

         $posts_count=Post::where('user_id',$id)
        ->where('status','PUBLISHED')
        ->orderBy('id','DESC')
        ->count();

         $notices_count=Notice::where('publicist_id',$publicist_name->id)
        ->where('status','PUBLISHED')
        ->orderBy('id','DESC')
        ->count();

            return view('web.profile',compact('user','publicist','posts','notices','notices_count','posts_count'));
        }else{

             $posts_count=Post::where('user_id',$id)
             ->where('status','PUBLISHED')
            ->orderBy('id','DESC')
            ->count();

            $notices_count=0;

            return view('web.profile',compact('user','posts','posts_count','notices_count'));
        }

    }

    public function notices(){
        $user_id=auth()->user()->id;
        $publicist_count=Publicist::where('user_id',$user_id)->count();
        if($publicist_count == 0){
            return redirect()->route('new_publicist');
        }else{
            $publicist=Publicist::where('user_id',$user_id)->first();
            if($publicist->status == 'INACTIVE'){
                return redirect()->route('panel')->with('info','Ya has completado tu perfil, pero aun no se han verificado tu datos');
            }else{
                
                $notices=Notice::orderBy('id','DESC')
                ->where('status','PUBLISHED')
                ->where('publicist_id',$publicist->id)->get();
        
                $count_post=Post::orderBy('id','DESC')
                ->where('status','PUBLISHED')
                ->where('user_id',$user_id)->count();

                $count_notices=Notice::orderBy('id','DESC')
                ->where('status','PUBLISHED')
                ->where('publicist_id',$publicist->id)->count();
        
                return view('web.noticies',compact('count_post','count_notices','notices'));
            }
        }
    }

    public function newPublicist(){
        return view('web.publicist_form');
    }

    public function storePublicist(PublicistStoreRequest $request){
        $user_id=auth()->user()->id;
        $publicist=new Publicist();
        $publicist->user_id=$user_id;
        $publicist->name=$request->name;
        $publicist->lastname=$request->lastname;
        $publicist->college=$request->college;
        $publicist->biography=$request->biography;
         if($request->file('file')){
            $image=$request->file('file')->store('publicist','documents');
            $publicist->file=$image;
        }
        $publicist->save();

        return redirect()->route('panel')->with('success','Tus datos ingresados han sido guardados con exito, debes esperar 24 horas mientras son verificados.');

    }


      public function newNotice(){
        $categories=Category::orderBy('id','DESC')
        ->where('type','NOTICES')
        ->get();
        $tags=Tag::orderBy('id','DESC')
        ->where('type','NOTICES')
        ->get();
        return view('web.new_notice',compact('categories','tags'));
    }

    public function storeNotice(NoticeStoreRequest $request){
        
        $post=new Notice();
        $post->publicist_id=auth()->user()->publicist->id;
        $post->category_id=$request->category_id;
        $post->name=$request->name;
        $post->slug=$request->slug;
        $post->excerpt=$request->excerpt;
        $post->body=$request->body;
        $post->status='DRAFT';
        if($request->file('file')){
            $image=$request->file('file')->store('notices','documents');
            $post->file=$image;
        }
        $post->save();

        $post->tags()->attach($request->tag_id);

        return redirect()->route('notices')->with('success','Noticia publicada con exito, debes esperar 24 horas habiles para que este activo en nuestra plataforma');
    }

    public function editNotice($id){
        $post=Notice::findOrFail($id);
        //$this->authorize('pass',$post);
        $categories=Category::orderBy('id','DESC')
        ->where('type','NOTICES')
        ->get();
        $tags=Tag::orderBy('id','DESC')
        ->where('type','NOTICES')
        ->get();
        return view('web.update_notice',compact('post','categories','tags'));    
    }

    public function updateNotice(NoticeUpdateRequest $request, $id){
        $post=Notice::findOrFail($id);
        $post->category_id=$request->category_id;
        $post->name=$request->name;
        $post->slug=$request->slug;
        $post->excerpt=$request->excerpt;
        $post->body=$request->body;
        $post->status='DRAFT';
        if($request->file('file')){
            $image=$request->file('file')->store('notices','documents');
            $post->file=$image;
        }
        $post->save();

        $post->tags()->sync($request->tag_id);

        return redirect()->route('notices')->with('success','Noticia editada con exito, estara en revisión antes de estar nuevamente activo en nuestra plataforma');
    }


    public function deleteNotice($id){
        $post=Post::findOrFail($id)->delete();
        //$this->authorize('pass',$post);
        return redirect()->route('notices')->with('success','Noticia eliminado con exito');
    }

    public function notice($slug){
        $post=Notice::where('slug',$slug)->first();

        return view('web.notice',compact('post'));
    }

     public function categoryNotice($slug){
        $category=Category::where('slug',$slug)->pluck('id')
        ->first();
        $posts=Notice::where('category_id',$category)
        ->orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);

        return view('web.list_notices',compact('posts'));
    }

     public function tagNotice($slug){
       
        $posts=Notice::whereHas('tags', function($query) use($slug){
            $query->where('slug',$slug);
        })
        ->orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);

        return view('web.list_notices',compact('posts'));
    }

    public function list_notices(){
        $posts=Notice::orderBy('id','DESC')
        ->where('status','PUBLISHED')->paginate(5);

        return view('web.list_notices',compact('posts'));
    }

    public function editProfile($id){
        $user=User::findOrFail($id);
        return view('web.edit_profile',compact('user'));
    }

    public function updateProfile(Request $request, $id){
        
        $user=User::findOrFail($id);

        if($user->publicist()){
            if($request->file){
                 $this->validate($request,[
                    'name'=>'required',
                    'last_name'=>'required',
                    'biography',
                    'image'=>'image'
                 ]);
            }else{
                 $this->validate($request,[
                    'name'=>'required',
                    'last_name'=>'required',
                    'biography'
                ]);
            }
           
            $publicist=Publicist::where('user_id',$id)
            ->first();
            $p=Publicist::findOrFail($publicist->id);
            $p->name=$request->name;
            $p->lastname=$request->last_name;
            $p->biography=$request->biography;
            $p->save();

            $user->name=$request->name;
            $user->last_name=$request->last_name;
            $user->username=$request->username;
            $user->email=$request->email;
            if($request->file){
                $image=$request->file('file')->store('profile','documents');
                $user->image=$image;
            }
            $user->save();

            return redirect()->route('profile_web',$user->id)->with('success','Perfil editado con exito');

        }
        else{

            if($request->file){
                 $this->validate($request,[
                    'name'=>'required',
                    'last_name'=>'required',
                    'image'=>'image'
                 ]);
            }else{
                 $this->validate($request,[
                    'name'=>'required',
                    'last_name'=>'required',
                ]);
            }

            $user->name=$request->name;
            $user->last_name=$request->last_name;
             if($request->file){
                $image=$request->file('file')->store('profile','documents');
                $user->image=$image;
            }
            $user->save();
        }
    }

}
