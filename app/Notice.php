<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
     protected $fillable=[
        'publicist_id','category_id','name','slug','excerpt','body','status','file'
    ];

    public function publicist(){
        return $this->belongsTo(Publicist::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /*public function getFileAttribute($img){
        return asset('documents/notices/'.$img);
    }*/
}
