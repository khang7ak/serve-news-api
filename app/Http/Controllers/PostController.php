<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category_post;
use Illuminate\Support\Facades\Storage;
use Image;
use phpDocumentor\Reflection\Types\AbstractList;
use Illuminate\Support\Facades\Redis;
use Illuminate\Redis\RedisServiceProvider;
use Session;
use Event;
use App\User;
use App\Notifications\TestNotification;
use App\Notifications\SendNotification;
use Notification;
use Illuminate\Notifications\Notifiable;
use Auth;
use Carbon\Carbon;

// use App\Event;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return view('post.list')
            ->with('posts', Post::getList($request->all()));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request, User $user)
    {
        // dd(Auth::user());
        $request->validate(
            [
                'post_title'   => 'required|string|max:255',
                'post_sub'     => 'required|string|max:255',
                'post_content' => 'required|string'
            ],
            [
                'post_title.required' => 'Tên bài viết là bắt buộc',
                'post_sub.required' => 'Nội dung tóm tắt không được để trống',
                'post_content.required' => 'Nội dung không được để trống'
            ]
        );
        $insertData = $request->all();

        if ($request->has('post_image')) {
            //Hàm kiểm tra dữ liệu
            $this->validate(
                $request,
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'post_image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'post_image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'post_image.max'   => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );
            $url = self::uploadFile($request->file('post_image'));

            $insertData['post_image'] = $url;
//            dd($insertData['post_image']);

        }
        Post::store($insertData);

        $user = Auth::user();
        $data = [
            'title' => 'Thông báo hệ thống',
            'content' => 'Bạn đã thêm 1 bài viết mới',
        ];

        $user->notify(new SendNotification($data));

        session()->flash(
            $insertData ? 'success' : 'error',
            $insertData ? 'Thêm mới bài viết thành công!' : 'Thêm thất bại!'
        );

        return redirect('post/create');
    }


    public function show($id)
    {
        $post = Post::getFirstById($id);

        if (!$post) {
            return abort(404);
        }


        return view('post.detail', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::getFirstById($id);

        if (!$post) {
            return abort(404);
        }


        return view('post.edit')->with('post', $post);
    }

    public static function uploadFile($file, $folder = null, $update = false, $oldSFile = null)
    {
        $realName = $file->getClientOriginalName(); // create name media
        $fileName = explode('.',$realName)[0] . '-' . time() . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')
            ->put('storage/upload/' . ($folder != null ? $folder . '/' : '') . $fileName, file_get_contents($file));
            // dd();
        if($update == true && $oldSFile != null) {
            $oldSFile2 = explode('/', $oldSFile);
            $oldSFile2 = $oldSFile2[sizeof($oldSFile2) - 1];
            Storage::disk('local')->delete('storage/upload/' . ($folder != null ? $folder . '/' : '') . $oldSFile2);
        }
        return url('storage/upload/' . ($folder != null ? $folder . '/' : '') . $fileName);
        // return $realName;
    }


    public function update(Request $request, $id)
    {
        // $request->validate(
        //     [
        //         'post_title'   => 'bail|required|string|max:255',
        //         'post_sub'     => 'required|string|max:255',
        //         'post_content' => 'required|string'
        //     ],
        //     [
        //         'post_title.required'   => 'Tên bài viết là bắt buộc',
        //         'post_sub.required'     => 'Nội dung tóm tắt không được để trống',
        //         'post_content.required' => 'Nội dung không được để trống'
        //     ]
        // );

        $updateData = Post::getFirstById($id);

        if (!$updateData) {
            return false;
        }

        $params = $request->all();
        if ($request->has('post_image')) {
            $this->validate($request,
                [
                    'post_image' => 'mimes:jpg,jpeg,png,gif',
                ],
                [
                    'post_image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'post_image.max'   => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );

            // $params->update(['post_image' => $request->file('post_image')->store('upfile')]);

            $url = self::uploadFile($request->file('post_image'));
            $params['post_image'] = $url;
        }


        $updateData->fill($params);
        $updateData->save();

        $user = Auth::user();
        $data = [
            'title' => 'Bạn đã sửa bài viết',
            'content' => 'Bạn đã sửa bài viết thành công',
        ];

        $user->notify(new SendNotification($data));

        $timeNotis = Auth::user()->notifications;
        $date = Carbon::now();
        // dd($timeNotis, $date);
        // foreach($timeNotis as $timeNoti) {
        //     dd($timeNoti->updated_at->calendar());
        // }
        session()->flash(
            $updateData ? 'success' : 'error',
            $updateData ? 'Sửa bài viết thành công!' : 'Sửa thất bại!'
        );


        return redirect('post');
    }




    public function destroy($id)
    {
        $deletePost = Post::query()->where('id', $id)->delete();

        $user = Auth::user();
        $data = [
            'title' => 'Thông báo hệ thống',
            'content' => 'Bạn đã xóa bài viết',
        ];

        $user->notify(new SendNotification($data));

        session()->flash(
            $deletePost ? 'success' : 'error',
            $deletePost ? 'Xóa thành công' : 'Ngu');

        return redirect('post');
    }


    public function showMain()
    {
        $postNew = Post::showNew();
        $post    = Post::showMain();
        $post1   = Post::showSub1();
        $post2   = Post::showSub2();
        // dd($post, $post1, $post2,$postNew);
        if($postNew == null || $post == null || $post1 == null || $post2 == null){
            return abort(500);
        }
        else{
            return view('/welcome', ['postNew'=>$postNew, 'post' => $post, 'post1' => $post1, 'post2' => $post2]);
        }
    }


    public function showCategory($type)
    {
        $postMain = Post::where('post_category', $type)->latest('updated_at')->take(1)->first();
        $postCategory = Post::where('post_category', $type)->latest('updated_at')->skip(1)->take(5)->get();
        $postNew = Post::showNew();

        // dd($type, $postMain, $postCategory, $postNew);
        if ($postMain == null) {
            return abort(404);
        }

        return view('post.category',
            ['postNews' => $postNew, 'postCategory' => $postCategory, 'postMain' => $postMain, 'title' => $type]);
    }

    public function testRedis(){
        $postNew = Post::showNew();
        $redis = app()->make('redis');
        // dd($redis);
        $redis->set('key1', $postNew);
        // dd($redis);
        $redis = $redis->get('key1');

        $json = json_decode($redis, true);
        dd($json);
        $redis = new Redis();

        // Thiết lập kết nối
        $redis->connect('192.168.1.5', 6379);

        if ($redis->ping() !== true)
        {
            echo "Redis Server not running ...";
            die;
        }

        dd($redis, $postNew, $json);
        return view('redis', ['redis'=>$redis]);
    }

    public function getListApi(){
        $post = Post::getListApi();
        // dd($post);
        $post = Session::put('getListApi', $post);
        $post = Session::get('getListApi');


        // $test = Session::has('getListApi');
        $test = Session::all();
        return $test;
    }

}




