<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [ 
    	'project_name', 'user_id'
    ] ;

    public function tasks() {
    	return $this->hasMany('App\Task');
    }

    public function user() {
         return $this->belongsTo('App\User') ;
     }


}
