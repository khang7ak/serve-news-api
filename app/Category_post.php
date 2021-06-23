<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_post extends Model
{
    protected $fillable = [
        'id',
        'post_category'
    ];

    public static function getCategory(){
        return Category_post::query()->select('post_category')->get();
    }

    public static function showCategory(){
        return Category_post::query()->select('post_category')->latest('updated_at')->take(6)->get();
    }

    public static function category(){
        return Category_post::query()->get();
    }

    public function posts()
    {
        return $this->hasMany('App\Post','post_category','post_category'); 
    }
}
