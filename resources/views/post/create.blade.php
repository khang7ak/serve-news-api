@extends('templates.master')

@section('title','Thêm mới bài viết')

@section('content')
    
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

    @if ( Session::has('success') )
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
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif

    <div class="container mx-auto">
        <p><a class="btn btn-primary" href="/post">Về danh sách</a></p>
        <div class="col-xs-4 col-xs-offset-4">
            <center><h4>Thêm bài viết</h4></center>
            <form action="{{ url('/post/create') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label for="post_title">Tên bài viết</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Tên bài viết"
                           maxlength=""
{{--                           pattern="^(?=.*[a-z])(?=.*[A-Z]).*[a-zA-Z0-9]{1,255}$"--}}
                    />
                </div>

                <div class="form-group">
                    <ul style="color: darkgrey">
                        <li>Có ít nhất một ký tự viết hoa</li>
                        <li>Có ít nhất một ký tự viết thường</li>
                        <li>Tiêu đề bài viết không được để trống</li>
                        <li>Độ dài không quá 255 ký tự</li>
                    </ul>
                </div>

                <div class="form-group">
                    <label for="post_category">Danh mục</label>
                    <div>
                        <select name="post_category" id="post_category" class="btn btn-outline-dark">
                            <option value="Pháp luật">Pháp Luật</option>
                            <option value="Xã Hội">Xã Hội</option>
                            <option value="Thể Thao">Thể Thao</option>
                            <option value="Đời Sống">Đời Sống</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="post_sub">Nội dung tóm tắt</label>
                    <input type="text" class="form-control" id="post_sub" name="post_sub" placeholder="Nội dung tóm tắt"
                           row="5"
{{--                           pattern="^(?=.*[A-Z]).*[a-zA-Z0-9]{1,255}$"--}}
                    />
                </div>

                <div class="form-group">
                    <ul style="color: darkgrey">
                        <li>Chứa ít nhất 1 ký tự viết hoa</li>
                        <li>Nội dung tóm tắt không được để trông</li>
                        <li>Độ dài không quá 255 ký tự</li>
                    </ul>
                </div>

                <div class="form-group">
                    <label for="post_content">Nội Dung</label>
                    <input type="text" class="form-control" id="post_content" name="post_content" placeholder="Nội dung"
                           maxlength="" pattern="^(?=.*[A-Z]).*$"/>
                </div>

                <div class="form-group">
                    <ul style="color: darkgrey">
                        <li>Chứa ít nhất 1 ký tự viết hoa</li>
                        <li>Nội dung không được để trống</li>
                    </ul>
                </div>

                <div class="form-group" action="" method="POST" enctype="multipart/form-data">
                    <label for="hinhthe">Chọn hình thẻ</label>
                    <input type="file" class="form-control" id="hinhthe" name="post_image"/>
                </div>

                <div class="form-group">
                    <label for="lylich">Chọn file lý lịch</label>
                    <input type="file" class="form-control" id="lylich" name="lylich"/>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" id="check-post-1" name="test" value="1">
                    <label class="form-check-label" for="check-post-1">Đây có phải là bài viết nổi bật hay
                        không</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="check-post-2" name="test" value="2">
                    <label class="form-check-label" for="check-post-2">Đây có phải là bài viết phụ loại 1 hay
                        không</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="check-post-3" name="test" value="3">
                    <label class="form-check-label" for="check-post-3">Đây có phải là bài viết phụ loại 2 hay
                        không</label>
                </div>

                <center>
                    <button type="submit" class="btn btn-primary my-5">Thêm</button>
                </center>

            </form>
        </div>
    </div>
@endsection
