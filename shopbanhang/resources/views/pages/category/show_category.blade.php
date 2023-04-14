@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
           <div style="float: left" class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"
                data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
           <div style="float: left" class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
   </div>
    @foreach($cate_name as $key=>$pro)
    <h2 class="title text-center">{{$pro->category_name}}</h2>
    @endforeach
    @foreach($category_by_id as $key=>$pro)
        <a href="{{\Illuminate\Support\Facades\URL::to('/chitietsanpham/').'/'.$pro->product_id}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product/').'/'.$pro->product_image}}" width="200" height="260" alt="" />
                    <h2>$ {{$pro->product_price}}</h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                </div>
{{--                <div class="product-overlay">--}}
{{--                    <div class="overlay-content">--}}
{{--                        <h2>$ {{$pro->product_price}}</h2>--}}
{{--                        <p>Easy Polo Black Edition</p>--}}
{{--                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
        </a>
    @endforeach
<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="" data-numposts="20"></div>

</div><!--features_items-->
@endsection
