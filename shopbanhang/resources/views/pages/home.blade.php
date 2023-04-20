@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach($all_product as $key=>$pro)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        {{csrf_field()}}
                        <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                        <input type="hidden"  class="cart_product_quantity_{{$pro->product_id}}" value="{{$pro->product_quantity}}" />
                        <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                        <a href="{{\Illuminate\Support\Facades\URL::to('/chitietsanpham/').'/'.$pro->product_id}}">
                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product').'/'.$pro->product_image}}" width="200" height="260" alt="" />
                    <h2>{{number_format($pro->product_price).'VNĐ'}}</h2>
                    <p>{{$pro->product_name}}</p>
                    </a>
                    <button type="button" data-id="{{$pro->product_id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                    <input type="button" data-toggle="modal" data-target="#xemnhanh"
                          value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$pro->product_id}}" name="add-to-cart">
                        </input>
                    </form>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
        <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title product_quickview_title" id="">
                            <span id="product_quickview_title"></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <style type="text/css">
                            span#product_quickview_content img{
                                width: 100%;
                            }
                            @media screen and (min-width: 768px){
                                .modal-dialog{
                                    width: 700px;
                                }
                                .modal-sm{
                                    width: 350px;
                                }
                            }
                            @media screen and (min-width: 992px){
                                .modal-lg{
                                    width: 1200px;
                                }
                            }
                        </style>
                        ...
                        <div class="row">
                            <div class="col-md-5">
                                <span id="product_quickview_image"></span>
                                <span id="product_quickview_gallery"></span>
                            </div>
                            <form>
                                @csrf
                                <div id="product_quickview_value"></div>
                            <div class="col-md-7">
                                <h2>
                                    <span id="product_quickview_title"></span>
                                </h2>
                                <p>Mã ID: <span id="product_quickview_id"></span> </p>
                                <p style="font-size: 20px;color: brown;font-weight: bold">Giá sản phẩm: <span id="product_quickview_price"></span></p>
                                <label>Số lượng: </label>
                                <input name="qty" type="number" min="1" class="cart_product_qty_" value="1">
                                <h4 style="font-size: 20px;color: brown;font-weight: bold">Mô tả sản phẩm</h4>
                                <p><span id="product_quickview_desc"></span> </p>
                                <p><span id="product_quickview_content"></span> </p>
                                <input type="button" value="Mua ngay" id="byquickview" class="btn btn-primary btn-sm add-to-cart-quickview"
                                       data-id="{{$pro->product_id}}"
                                       name="add-to-cart">
                                <div id="before_send"></div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary">Đi tới sản phẩm</button>
                    </div>
                </div>
            </div>
        </div>
        </a>
    @endforeach

</div><!--features_items-->


@endsection
