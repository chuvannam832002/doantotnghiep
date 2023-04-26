@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">{{$meta_title}}</h2>


                    <div class="product-image-wrapper">
                        <div class="single-products">

                            <div class="text-left" style="margin: 10px 0;padding: 2px">
                                <p>{{$post->post_desc}}</p>
                                <p>{{$post->post_content}}</p>
                            </div>
                            <div class="text-center" style="margin: 10px 0;padding: 2px">
                                <p style="margin-left: 200px;"><img src="{{\Illuminate\Support\Facades\URL::to('public/upload/product').'/'.$post->post_image}}" width="500" height="200"> </p>
                            </div>
                            <div class="text-left" style="margin: 10px 0;padding: 2px">
                                <p>{{$post->post_meta_desc}}</p>
                            </div>
                        </div>
                        <div class="text-right">
{{--                            <a href="{{\Illuminate\Support\Facades\URL::to('/bai-viet').'/'.$pro->post_slug}}" style="color: #000" class="btn btn-default btn-sm">Xem bài viết</a>--}}
                        </div>
                    </div>
    </div><!--features_items-->
@endsection
