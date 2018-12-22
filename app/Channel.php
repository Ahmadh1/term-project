<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title', 'slug'];

    /*
    	Relationship with Discussions
    		A Channel hasMany Discussions
     */
    
    public function discussions() {
    	return $this->hasMany('App\Discussion');
    }
}
