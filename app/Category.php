<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category_posts';
    protected $fillable = ['post_category', 'description'];


}
