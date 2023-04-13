@extends('welcome')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Kết quả tìm kiếm</h2>
        @foreach($product_search as $key=>$pro)
            <a href="{{'http://localhost:8080/shopbanhang/chitietsanpham/'.$pro->product_id}}">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{'http://localhost:8080/shopbanhang/public/upload/product/'.$pro->product_image}}" width="200" height="260" alt="" />
                                <h2>{{number_format($pro->product_price).'VNĐ'}}</h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                            </div>
                            {{--                <div class="product-overlay">--}}
                            {{--                    <div class="overlay-content">--}}
                            {{--                        <h2>$ {{$pro->product_price}}</h2>--}}
                            {{--                        <p>{{$pro->product_name}}</p>--}}
                            {{--                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>--}}
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
    </div>

@endsection
