<?php

namespace App\Services;

use App\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExamsService {

	public function getAllPaginate(){
		return Post::getList();
	}

	public static function getAll(){
		return Post::getListApi();
	}

	public static function getFirstById($id){
        return Post::getFirstById($id);
    }
	
}