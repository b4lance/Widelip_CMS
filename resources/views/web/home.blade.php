<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/moment-with-locales.min.js')}}"></script>
@extends('layouts.app')

@section('content')
<div class="container">

    	<div class="row">
        <div class="col-sm-12">
        <div class="jumbotron p-3 p-md-5 text-white rounded bg-primary">
        <div class="col-md-12 px-0">
          <h1 class="display-4 font-italic">Widelip</h1>
          <p class="mb-4">Widelip es una plataforma que te permite cimpartir articulos, noticias y visualizar tus libros preferidos de manera online...</p>
            Aun no te registras?<br>
            <a href="{{route('register')}}" class="btn btn-success mt-4">Registrate</a>
        </div>
      </div>
            </div>
        
        	<div class="row">
                <div class="col-sm-12">
        
                    <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#articles">Ultimos Articulos</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#notices">Ultimas Noticias</a>
                          </li>
                    </ul>
        
                <div id="myTabContent" class="tab-content">
                      <div class="tab-pane fade show active" id="articles">
                            @foreach($posts as $p)
    <div class="card mt-2" style="margin-bottom:10px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class=""><a href="{{route('post',$p->slug)}}" class="">{{$p->name}}</a></h5>
                                <div class="d-flex justify-content-between">
                                   <div><span class="fa fa-folder-open-o"></span> <a href="{{route('category',$p->category->slug)}}">{{$p->category->name}}</a> Publicado 
                                    <script>
                                         function since(d){
                                            var lang=moment.lang('es');
                                            return document.write(moment(d).fromNow());
                                        }
                                        since('{{$p->created_at}}')
                                    </script> 
                                  </div>
                                   <div><span class="fa fa-comment-o"></span> 0</div>
                                </div>    
                                </div>
                                <div class="card-body">
                                <img src="{{$p->file}}" alt="Imagen del Post" class="img-fluid">
                                <p>{{$p->excerpt}} <a href="{{route('post',$p->slug)}}">Leer Más</a></p>
                                <p>Creado Por:</p>
                                <p><a href="{{route('profile_web',$p->user->id)}}"><img src="{{$p->user->image}}" alt="" width="60px;" class="img-thumbnail"> {{$p->user->name}}</a></p><br>
                                @foreach($p->tags as $t)
                                <a href="{{route('tag',$t->slug)}}" class="mr-2"><span class="fa fa-tag"></span> {{$t->name}}</a>
                                @endforeach
                                 </div>
    </div>
@endforeach
                
                      </div>

                      <div class="tab-pane fade show" id="notices">
                        <div class="card">
                            <div class="card-body">
                            
                    @foreach($notices as $n)
                            <div class="row card-margin">
                                <div class="col-md-4">
                                      <img src="{{$n->file}}" alt="" class="" width="100%" height="200px">
                                 </div>
                          
                              <div class="col-md-8">
                              <h4 class="card-title"><a href="{{route('notice',$n->slug)}}">{{$n->name}}</a></h4>
                                  <p>{{$n->excerpt}}</p>
                                  
                                  <p class="card-text"><p>Creado Por:</p>
                              <p><a href="{{route('profile_web',$n->publicist->user->id)}}"><img src="{{$n->publicist->user->image}}" alt="" width="60px;" class="img-thumbnail"> {{$n->publicist->name}}</a></p><br>
                                  </p>
                                <h6 class="card-subtitle mb-2 text-muted">{{\Carbon\Carbon::parse($n->created_at)->format('d-m-Y')}}</h6>
                                  <a href="{{route('notice',$n->slug)}}">Ver más</a>
                              </div>
                          </div>
                          <hr>
                    @endforeach

                     </div>
                          </div>
                      </div>
        
                </div>

                <!--<nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        </li>

                        <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]"><a class="page-link" href="#" v-on:click.prevent="changePage(page)">@{{page}}</a></li>
                        
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                         <a class="page-link" href="#" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                        </li>
                    </ul>
                </nav>-->
                

            </div>

            <div class="col-sm-12 col-md-4">
                
            </div>
        
            </div>
</div>
@endsection
@section('scripts')
<script>
  new Vue({
    el:'#app',
    data:{
      posts:[],
        pagination:{
        'total':0,
        'current_page':0,
        'per_page':0,
        'last_page':0,
        'from':0,
        'to':0,
        },
        offset: 3,
        url:'articulo/',
        url_tag:'etiqueta/',
        url_category:'categoria/'
    },
      methods:{
            get_post(page){
                var url='get_post?page=' + page;
                axios.get(url).then(response=>{
                    this.posts=response.data.posts.data;
                    this.pagination=response.data.pagination;
                }).catch(error=>{

                });
            },
            changePage(page){
                 this.pagination.current_page=page;
                this.get_post(page);
            },
            since(d){
                moment.lang('es');
                return moment(d).fromNow();
            }
        },
        created(){
            this.get_post();
        },
        computed:{
        isActived:function(){
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginacion
        pagesNumber:function(){
            if(!this.pagination.to){
                return [];
            }
            var from=this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        }
    }
  });
</script>
<script>
  window.onload=Load();
</script>
@endsection
