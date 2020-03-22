<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
        protected $fillable = [
        	'user_id',
        	'category_id',
        	'title',
        	'body',
        	'image',
        ];

        public function comments(){
	        return $this->hasMany('App\Comment');
	    }

	// categoriesテーブルとのリレーションを記述。これにより、postメソッドでcategoriesテーブルの情報を引っ張ってくることができる
	    public function category(){
	    	return $this->belongsTo('App\Category');
	    }

	    public function user(){
	    	return $this->belongsTo('App\User');
	    }
}
