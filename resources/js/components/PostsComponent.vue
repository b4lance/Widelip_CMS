<template>
     <div class="tab-pane fade show active" id="articles">
                            <div class="card mt-2" v-for="p in posts" style="margin-bottom:10px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class=""><a :href="url+p.slug" class="text-white">{{p.name}}</a></h5>
                                <div class="d-flex justify-content-between">
                                   <div><span class="fa fa-folder-open-o"></span> <a :href="url_category+p.category.slug">{{p.category.name}}</a> Publicado {{since(p.created_at)}} por @{{p.user.username}}</div>
                                   <div><span class="fa fa-comment-o"></span> 0</div>
                                </div>    
                                </div>
                                <div class="card-body">
                                <img v-show="p.file" :src="p.file" alt="Imagen del Post" class="img-fluid">
                                <p>{{p.excerpt}} <a :href="url+p.slug">Leer Más</a></p>
                                <a :href="url_tag+t.slug" v-for="t in p.tags" class="mr-2"><span class="fa fa-tag"></span> @{{t.name}}</a>
                                </div>
                            </div>
         </div>
        
</template>

<script>
    export default {
        props:{
            url: String,
        },
        data(){
            return {
                posts:[],
                pagination:{
                'total':0,
                'current_page':0,
                'per_page':0,
                'last_page':0,
                'from':0,
                'to':0,
                },
                offset: 3
            }
        },
        methods:{
            get_post(page){
                var url='get_post?page=' + page;
                axios.get(url).then(response=>{
                    this.posts=response.data.posts.data;
                    this.pagination = response.pagination;
                }).catch(error=>{

                });
            },
            changePages(page){
            let me=this;

            if((me.pagination.last_page != (page - 1)) && ((page - 1) >= 0)){
                //Actualiza la pagina Actual
                me.pagination.current_page = page;
                //Envia la peticion para visualizar la data de la pagina
                me.get_post(page);
            }            
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
    }
</script>
