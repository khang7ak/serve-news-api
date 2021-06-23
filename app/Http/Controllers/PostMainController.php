<?php

namespace App\Http\Controllers;

use App\PostMain;
use Illuminate\Http\Request;
use voku\helper\ASCII;

class PostMainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('post-main.list')->with('postmains', PostMain::getList($request->all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postmain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'post_title' => 'required|string|max:255',
                'post_sub' => 'required|string|max:255',
                'post_content' => 'required|string'
            ],
            [
                'post_title.required' => 'Tên bài viết là bắt buộc',
                'post_sub.required' => 'Nội dung tóm tắt không được để trống',
                'post_content.required' => 'Nội dung bài viết không được để trống'
            ]
        );

        $insertData = PostMain::store($request->all());

        session()->flash(
            $insertData ? 'success' : 'error',
            $insertData ? 'Thêm mới bài viết thành công' : 'Thêm bài viết thất bại'
        );

        return redirect('postmain/create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postmain = PostMain::getFirstById($id);

        if (!$postmain) {
            return abort(404);
        }

        return view('post-main.detail', ['postmain' => $postmain]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postmain = PostMain::getFirstById();

        if (!$postmain) {
            return abort(404);
        }

        return view('post-main.edit')->with('postmain', $postmain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_sub' => 'required|string|max:255',
            'post_content' => 'required|string'
        ], [
            'post_title.required' => 'Không phải dạng vừa đâu',
            'post_sub.required' => 'Không phải dạng vừa đâu',
            'post_content.required' => "Mà phải dạng rộng ra"
        ]);

        $updateData = PostMain::customUpdate($id, $request->all());

        session()->flash(
            $updateData ? 'success' : 'error',
            $updateData ? 'Không phải dạng vừa đâu' : 'Mà phải dạng rộng ra'
        );

        return redirect('post-main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
