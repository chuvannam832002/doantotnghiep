@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
{{--           <div style="float: left" class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/"--}}
{{--                data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>--}}
{{--           <div style="float: left" class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>--}}
{{--   </div>--}}
    @foreach($cate_name as $key=>$pro)
    <h2 class="title text-center" style="margin-top: 20px">{{$pro->category_name}}</h2>
    @endforeach
    @foreach($category_by_id2 as $key=>$pro)
        <a href="{{\Illuminate\Support\Facades\URL::to('/chitietsanpham/').'/'.$pro->product_id}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        {{csrf_field()}}
                        <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                        <input type="hidden" value="{{\Illuminate\Support\Facades\URL::to('/public/upload/product').'/'.$pro->product_image}}" class="product_image_{{$pro->product_id}}">
                        <input type="hidden" value="{{\Illuminate\Support\Facades\URL::to('/chitietsanpham/').'/'.$pro->product_id}}" class="product_url_{{$pro->product_id}}">
                        <input type="hidden"  class="cart_product_quantity_{{$pro->product_id}}" value="{{$pro->product_quantity}}" />
                        <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                        <a id="{{$pro->product_id}}" onclick="add_wistlistview(this.id);" href="{{\Illuminate\Support\Facades\URL::to('/chitietsanpham/').'/'.$pro->product_id}}">
                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product/').'/'.$pro->product_image}}" width="200" height="260" alt="" />
                    <h2>$ {{$pro->product_price}}</h2>
                    <p>{{$pro->product_name}}</p>
                        </a>
                    <button type="button" data-id="{{$pro->product_id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                    <input type="button" data-toggle="modal" data-target="#xemnhanh"
                           value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$pro->product_id}}" name="add-to-cart">
                    </form>
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
                </ul>
            </div>
        </div>
    </div>
            <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title product_quickview_title" id="">
                                <span id="product_quickview_title" style="font-size: 30px;color: brown"></span>
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary">Đi tới sản phẩm</button>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="" data-numposts="20"></div>
</div><!--features_items-->
<script type="text/javascript">
    function add_wistlistview(clicked_id) {
        var id = clicked_id;
        var name = $('.cart_product_name_'+id).val();
        var image = $('.product_image_'+id).val();
        var url = $('.product_url_'+id).val();
        var price = $('.cart_product_price_'+id).val();
        var  newItem = {
            'url':url,
            'name':name,
            'price':price,
            'id':id,
            'image':image,
        }
        if(localStorage.getItem('data2')==null)
        {
            localStorage.setItem('data2','[]');
        }
        var olddata = JSON.parse(localStorage.getItem('data2'));
        var matches = $.grep(olddata,function (obj) {
            return obj.id == id;
        })
        if(matches.length)
        {
            swal("Thông báo", "Sản phẩm bạn đã yêu thích , không thể thêm", "error");
        }
        else{
            olddata.push(newItem);
            localStorage.setItem('data2',JSON.stringify(olddata));
            window.location.reload();
        }

    }
    function add_wistlist(clicked_id) {
        var id = clicked_id;
        var name = $('.cart_product_name_'+id).val();
        var image = $('.product_image_'+id).val();
        var url = $('.product_url_'+id).val();
        var price = $('.cart_product_price_'+id).val();
        var  newItem = {
            'url':url,
            'name':name,
            'price':price,
            'id':id,
            'image':image,
        }
        if(localStorage.getItem('data')==null)
        {
            localStorage.setItem('data','[]');
        }
        var olddata = JSON.parse(localStorage.getItem('data'));
        var matches = $.grep(olddata,function (obj) {
            return obj.id == id;
        })
        if(matches.length)
        {
            swal("Thông báo", "Sản phẩm bạn đã yêu thích , không thể thêm", "error");
        }
        else{
            alert('Sản phẩm đã được thêm vào yêu thích ');
            olddata.push(newItem);
            localStorage.setItem('data',JSON.stringify(olddata));
            window.location.reload();
        }

    }


</script>
@endsection
