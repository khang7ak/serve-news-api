@extends('templates.master')

@section('title','Quản lý bài viết')

@section('content')
    <div class="content-wrapper mx-auto">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Quản lý bài viết</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        @if ( Session::has('success'))

            <div class="alert alert-success alert-dismissible container" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        @if ( Session::has('error') )
            <div class="alert alert-danger alert-dismissible container" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="close" data-dissmiss="alert" aria-label="Close">
                    <span aria-hidden="false">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif

        <div class="container mx-auto">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <p><a class="btn btn-primary" href="/post/create">Thêm mới</a></p>
                        <form action="" method="GET" class="navbar-form" role="search">
                            <div class="form-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-primary">Tìm</button>
                        </form>
                        <table id="Datalist" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề bài viết</th>
                                <th>Danh mục</th>
                                <th>Nội dung tóm tắt</th>
                                <th>Hình ảnh</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 0 ?>
                            @foreach ($posts as $post)
                                <?php $stt = $stt +1 ?>
                                <tr>
                                    <td>{{ $stt }}</td>
                                    <td>
                                        <a href="{{ Route('post.detail', $post->id) }}"
                                           target="blank">{{ $post->post_title }}</a>
                                    </td>
                                    <td>{{ $post->post_category }}</td>
                                    <td>{{ $post->post_sub }}</td>
                                    <td><img src="{{ $post->post_image }}" class="img-fluid"></td>
                                    <td>
                                        <a href="/post/{{ $post->id }}/edit" class="btn btn-primary">Sửa</a>
                                        <a href="/post/{{ $post->id }}/delete" class="btn btn-primary delete"
                                           onclick="return confirm('Are you sure?')"> Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            {{ $posts->links() }}
        </div>
@endsection
