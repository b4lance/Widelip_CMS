<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicist extends Model
{
	protected $fillable=[
		'user_id','name','lastname','college','biography','file','status'
	];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getFileAttribute($file){
    	return asset('articles/'.$file);
    }
}
