@extends ('templates.master')

@section ('title', 'Trang tin')

@section ('content')
    <div class="container" id="item-3">
        <div class="row">
            <div class="col text-left"><h3>{{ $post->post_category }}</h3></div>
            <div class="col text-right"><p><i>Thứ .. , ngày .. tháng 8 năm 2020</i></p></div>
        </div>
    </div>
    <div class="container" id="item-4">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{ $post->post_title }}</h4>
                            <p><i>{{ $post->updated_at }}</i></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-xs-12"></div>
                        <div class="col-md-10 col-xs-12">
                            <h6>{{ $post->post_sub }}</h6>
                            <p>{{ $post->post_content }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12" style="background: #6d7a86"></div>
        </div>
    </div>
@stop
