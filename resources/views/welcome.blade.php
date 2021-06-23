@extends ('templates.master')

@section('title', 'Trang chủ')

@section('content')

    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-9 col-xs-12">--}}
    {{--                <div class="container">--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-md-8 col-xs-12">--}}
    {{--                            <div>--}}
    {{--                                <a href="">--}}
    {{--                                    <img src="{{ asset('IMG_0137.jpg') }}" class="img-fluid">--}}
    {{--                                </a>--}}
    {{--                            </div>--}}
    {{--                            <div>--}}
    {{--                                <a href="{{ route('post.detail', $post->id) }}"><h6>{{ $post->post_title }}</h6></a>--}}
    {{--                            </div>--}}
    {{--                            <div>--}}
    {{--                                <p>{{ $post->post_sub }}</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                        <div class="col-md-4 col-xs-12">--}}

    {{--                            <ul class="list-group">--}}
    {{--                                @foreach($post1 as $post1)--}}
    {{--                                <li class="list-group-item">--}}
    {{--                                    <a href="">--}}
    {{--                                        {{ $post1->post_title }}--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                @endforeach--}}
    {{--                            </ul>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="container">--}}
    {{--                    <div class="row">--}}
    {{--                        @foreach($post2 as $post2)--}}
    {{--                        <div class="col-3">--}}
    {{--                            <a href="{{ route('post.detail', $post2->id) }}">--}}
    {{--                                <img src="{{ asset('IMG_0137.jpg') }}" class="img-fluid">--}}
    {{--                            </a>--}}
    {{--                            <a href="">--}}
    {{--                                <h6>{{ $post2->post_title }}</h6>--}}
    {{--                            </a>--}}
    {{--                            <p>{{ $post2->post_sub }}</p>--}}
    {{--                        </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-md-3"></div>--}}
    {{--        </div>--}}
    {{--    </div>--}}



    <div class="container">
        <div class="row">
            <div class="col-6">
                <ul class="menu-ul-1 text-left">
                    <li class="menu-li-1"><a href="">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-graph-up" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z"/>
                                <path fill-rule="evenodd"
                                      d="M14.39 4.312L10.041 9.75 7 6.707l-3.646 3.647-.708-.708L7 5.293 9.959 8.25l3.65-4.563.781.624z"/>
                                <path fill-rule="evenodd"
                                      d="M10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4h-3.5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </a></li>
                    <li class="menu-li-1 menu-li-12"><a href="">Kỳ thi tốt nghiệp THPT</a></li>
                    <li class="menu-li-1 menu-li-12"><a href="">Tình hình dịch COVID-VŨ HÁN</a></li>
                </ul>
            </div>
            <div class="col-3"><a href="" style="color: black; background: #eeeeee; padding: 3px 10px">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-alarm" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 15A6 6 0 1 0 8 3a6 6 0 0 0 0 12zm0 1A7 7 0 1 0 8 2a7 7 0 0 0 0 14z"/>
                        <path fill-rule="evenodd"
                              d="M8 4.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.053.224l-1.5 3a.5.5 0 1 1-.894-.448L7.5 8.882V5a.5.5 0 0 1 .5-.5z"/>
                        <path
                            d="M.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                        <path fill-rule="evenodd"
                              d="M11.646 14.146a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1-.708.708l-1-1a.5.5 0 0 1 0-.708zm-7.292 0a.5.5 0 0 0-.708 0l-1 1a.5.5 0 0 0 .708.708l1-1a.5.5 0 0 0 0-.708zM5.5.5A.5.5 0 0 1 6 0h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                        <path d="M7 1h2v2H7V1z"/>
                    </svg>
                    Tin mới nhất</a></div>
            <div class="col-3 text-right">Thứ 2, ngày 10 tháng 8 năm 2020</div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-xs-12 post-main">
                            <a href="{{ route('post.detail', $post->id) }}" title=""><img
                                    src="{{ $post->post_image }}" class="img-fluid"></a>
                            <a href="{{ route('post.detail', $post->id) }}" title="{{ $post->post_title }}">
                                <h3>{{ $post->post_title }}</h3></a>
                            <p>{{ $post->post_sub }}</p>
                        </div>
                        <div class="col-md-4 col-xs-12 post-1">
                            <ul class="menu ">
                                @foreach($post1 as $post1)
                                    <li class=""><a href="{{ route('post.detail', $post1->id) }}"
                                                    title="">{{ $post1->post_title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach($post2 as $post2)
                            <div class="col-md-3 post-2" id="postSub2">
                                <a href="{{ route('post.detail', $post2->id) }}" title="{{ $post2->post_title }}"><img
                                        src="{{ $post2->post_image }}" style="height: 146px;" class="img-fluid"></a>
                                <a href="{{ route('post.detail', $post2->id) }}"
                                   title="{{ $post2->post_title }}">{{ $post2->post_title }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-3" style="background: darkgrey"></div>
        </div>
    </div>

    <div class="img">
        <div class="title">
            <div class="container">
                <div class="row">
                    <div class="col-1">
                        <h4> Ảnh</h4>
                    </div>
                    <div class="col-3">
                        <h6>MEGASTORY</h6>
                    </div>
                    <div class="col-8 text-right">
                        <p>Xem thêm</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="item-5">
            <div class="row">
                @foreach($postNew as $postNew)
                <div class="col-3" id="postNew">
                    <a class="text-center" href="" title=""><img class="img-fluid text-center" src="{{ $postNew->post_image }}"></a>
                    <a class="" href="" title=""><p>{{ $postNew->post_title }}</p>
                    </a>
                    <a class="text-left" href="" title=""><i>{{ $postNew->post_category }}</i></a>
                </div>
                @endforeach

            </div>
        </div>
    </div>




@endsection
