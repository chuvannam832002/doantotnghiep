@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Danh mục bài viết</h2>
            @foreach($post as $key=>$pro)
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="text-center" style="margin: 10px 0;padding: 2px">
                                    {{csrf_field()}}

                                    <a href="{{\Illuminate\Support\Facades\URL::to('/bai-viet/').'/'.$pro->post_slug}}">
                                        <img style="float: left;width:30%;padding: 5px;height: 160px" src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product').'/'.$pro->post_image}}" width="200" height="260" alt="" />
                                        <p style="color: #000;padding: 5px;font-weight: bold">{{$pro->post_title}}</p>
                                        <p style="color: #000;padding: 5px">{{$pro->post_desc}}</p>
                                    </a>
                            </div>
                            {{--                <div class="product-overlay">--}}
                            {{--                    <div class="overlay-content">--}}
                            {{--                        <h2>$ {{$pro->product_price}}</h2>--}}
                            {{--                        <p>{{$pro->product_name}}</p>--}}
                            {{--                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>--}}
                            {{--                    </div>--}}
                            {{--                </div>--}}
                        </div>
                        <div class="text-right">
                            <a href="{{\Illuminate\Support\Facades\URL::to('/bai-viet').'/'.$pro->post_slug}}" style="color: #000" class="btn btn-default btn-sm">Xem bài viết</a>
                        </div>
                    </div>
                </a>
            @endforeach
    </div><!--features_items-->
@endsection
