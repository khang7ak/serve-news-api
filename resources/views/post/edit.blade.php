@extends('templates.master')

@section ('title','Chỉnh sửa bài viết')

@section ('content')

    <div class="content-wrapper mx-auto">
        <div class="content-wrapper container mx-auto">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Quản lý bài viết</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            @if( Session::has('success') )
                <div class="alert alert-success alert-dismissible container" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible container" role="alert">
                    @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif

            <p><a href="/post" class="btn btn-primary">Trở về</a></p>
            <div class="col-xs-4 col-xs-offset-4">
                <center><h4>Sửa bài viết</h4></center>
                <form action="{{ route('post.edit.post', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{!! $post->id !!}"/>
                    <div class="form-group">
                        <label for="post_title">Tên bài viết</label>
                        <input type="text" class="form-control" id="post_title" name="post_title"
                               placeholder="Tên bài viết" maxlength="" required value="{{ $post->post_title }}"
{{--                               pattern="^(?=.*[a-z])(?=.*[A-Z]).*[a-zA-Z0-9]{1,5000}$"--}}
                        />
                    </div>

                    <div class="form-group">
                        <ul style="color: darkgrey">
                            <li>Có ít nhất một ký tự viết hoa</li>
                            <li>Có ít nhất một ký tự viết thường</li>
                            <li>Độ dài không quá 255 ký tự</li>
                        </ul>
                    </div>

                    <div style="" class="form-group">
                        <label for="post_category">Danh mục</label>
                        <select name="post_category" id="post_category" class="btn btn-outline-secondary">
                            <option value="{{ $post->post_category }}">{{ $post->post_category }}</option>
                            <option value="Pháp luật">Pháp Luật</option>
                            <option value="Xã Hội">Xã Hội</option>
                            <option value="Thể Thao">Thể Thao</option>
                            <option value="Đời Sống">Đời Sống</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_sub">Nội dung tóm tắt</label>
                        <input type="text" class="form-control" id="post_sub" name="post_sub"
                               placeholder="Nội dung tóm tắt" required value="{{ $post->post_sub }}"
                              {{-- pattern="^(?=.*[A-Z]).*[a-zA-Z0-9]{1,25500}$" --}}
                        />
                    </div>

                    <div class="form-group">
                        <ul style="color: darkgrey">
                            <li>Chứa ít nhất 1 ký tự viết hoa</li>
                            <li>Độ dài không quá 255 ký tự</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="post_content">Nội Dung</label>
                        <input type="text" class="form-control" id="post_content" name="post_content"
                               placeholder="Nội dung" maxlength="" required value="{{ $post->post_content }}"
                               pattern="^(?=.*[A-Z]).*$"/>
                    </div>

                    <div class="form-group">
                        <ul style="color: darkgrey">
                            <li>Chứa ít nhất 1 ký tự viết hoa</li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="hinhthe">Chọn hình thẻ</label>
                        <input type="file" class="form-control" id="hinhthe" name="post_image"/>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="" name="test" value="1">
                        <label class="form-check-label" for="">Đây có phải là bài viết chính hay
                            không</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="" name="post_sub_1" value="1">
                        <label class="form-check-label" for="">Đây có phải là bài viết phụ loại 1 hay
                            không</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="" name="post_sub_2" value="1">
                        <label class="form-check-label" for="">Đây có phải là bài viết phụ loại 2 hay
                            không</label>
                    </div>

                    <center>
                        <button type="submit" class="btn btn-primary"> Lưu lại</button>
                    </center>
                </form>
            </div>
        </div>
@endsection
