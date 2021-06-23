<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class PostMain extends Model
{
    protected $fillable = [
        'post_title', 'post_category', 'post_sub', 'post_content'
    ];

    public static function getList(array $array = [])
    {
        $query = PostMain::query();
    }

    public static function getFirstById($id)
    {
        return PostMain::query()->find($id);
    }

    public static function store(array $params = [])
    {
        $postmain = new PostMain();
        $postmain->fill($params);
        $postmain->save();

        return $postmain;
    }

    public static function customUpdate($id, array $params = []){
        $postmain = PostMain::getFirstById($id);

        if(!$postmain){
            return false;
        }

        $postmain->fill($params);
        $postmain->save();

        return $postmain;
    }



}
