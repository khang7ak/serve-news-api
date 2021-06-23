<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo('App\Category_post', 'post_category', 'post_category');
    }


    protected $fillable = [
        'post_title',
        'post_category',
        'post_sub',
        'post_content',
        'test',
        'post_sub_1',
        'post_sub_2',
        'view_count',
        'post_image',
    ];


    public static function getListApi()
    {
        return Post::query()->get();
    }

    public static function getList(array $params = [], $perPage = 10)
    {
        $query = Post::query();

        if (isset($params['keyword'])) {
            $query = $query->where('post_title', 'LIKE', '%' . $params['keyword'] . '%');
        }
        return $query->paginate($perPage);
    }

    public static function getFirstById($id)
    {
        return Post::query()->find($id);
    }


    public static function getFirstByIdViewCount($id, array $params = [])
    {
        $post = Post::getFirstById($id);

        if (!$post) {
            return false;
        }

        // $post->increment("view_count");

        // $viewSession = Session::put('view_count');
        $viewSession = Session::get('view_count');
        // dd($viewSession);
        // dd($viewSession);
        if ($viewSession != 1) {
            Session::put('view_count', 1);
            $viewSession = Session::get('view_count');
            // dd($viewSession);
            $post->increment('view_count');
            // DD($post);
        }
        // dd($viewSession);
        $post->save();
        // dd($viewSession);

        return [$post, $viewSession];
    }

    public function getViewCount($id)
    {
        return Post::query()->find($id)->select('view_count');
    }

    public static function store(array $params = [])
    {
        $post = new Post();
        // dd($params);
        $post->fill($params);

        $post->save();

        return [$post];
    }

    public static function customUpdate($id, array $params = [])
    {
        $post = Post::getFirstById($id);

        if (!$post) {
            return false;
        }

        $post->fill($params);
        $post->save();

        return redirect()->back();
    }

    public static function showMain()
    {
        $showMain = Post::query()->where('test', 1)->latest('updated_at')->first();
        return $showMain;
    }

    public static function showSub1()
    {
        return Post::query()->where('test', 2)->latest('updated_at')->take(7)->get();
    }

    public static function showSub2()
    {
        return Post::query()->where('test', 3)->latest('updated_at')->take(4)->get();
    }

    public static function showCategory()
    {
        return Post::query()->where('post_category')->first();
    }

    public static function showNew()
    {
        return Post::query()->latest('updated_at')->take(4)->get();
    }



//    public static function showMain()
//    {
//        $postMain = Post::query()->where('test', 1)->latest('updated_at')->skip(1)->update(['test' => 0]);
//    }
// $postMain = Post::where('post_category', $type)->latest('updated_at')->take(1)->get();
//             $postCategory = Post::where('post_category', $type)->latest('updated_at')->skip(1)->take(5)->get();
//             $postNew = Post::showNew();

}

