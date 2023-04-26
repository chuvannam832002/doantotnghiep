<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />
{{--    <meta property="og:image" content="{{$image_og}}" />--}}
    <meta property="og:site_name" content="thiatv.com" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$url_canonical}}" />
    <meta property="og:type" content="website" />

    <title>{{$meta_title}}</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.min.css')}}" rel="stylesheet">
    <link href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('public/frontend/js/html5shiv.js')}}"></script>

    <script src="{{asset('js/respond.min.js"')}}></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<style>
    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
    }

    .pagination a:hover:not(.active) {background-color: #ddd;}
    /*.demo {*/
    /*    width:450px;*/
    /*}*/
    /*ul {*/
    /*    list-style: none outside none;*/
    /*    padding-left: 0;*/
    /*    margin-bottom:0;*/
    /*}*/
    /*li {*/
    /*    display: block;*/
    /*    float: left;*/
    /*    margin-right: 6px;*/
    /*    cursor:pointer;*/
    /*}*/
    img {
        display: block;
        height: auto;
        max-width: 100%;
    }
</style>
<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="public/frontend/images/lunar.jpg" style="width: 220px;height: 140px" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                            <?php
                            $customer_id = \Illuminate\Support\Facades\Session::get('customer_id');
                            $shipping_id = \Illuminate\Support\Facades\Session::get('shipping_id');
                            if($customer_id!=NULL&& $shipping_id==NULL)
                            {
                                ?>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php
                            }elseif($customer_id!=NULL&&$shipping_id!=NULL)
                            {
                                ?>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php
                            }else{
                                ?>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <?php
                            }
                            ?>
{{--                            @if(\Illuminate\Support\Facades\Session::get('number')==null)--}}
{{--                            @endif--}}
                            <?php
                            $a = \Illuminate\Support\Facades\Session::get('number');
                            if(\Illuminate\Support\Facades\Session::get('number')>0)
                            {
                                ?>
                            <li id="count_cart"></li>
                                <?php

                            }
                            else{
                                ?>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <span class="badges" style="background: red;padding: 5px;border-radius: 10px;font-size: 14px;
                                                            font-weight: bold;color: #fff">0</span></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if($customer_id!=NULL)
                            {
                            ?>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('history')}}"><i class="fa fa-history"></i> Lịch sử giao hàng</a></li>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                            <?php
                                }else{
                                    ?>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>

                            <?php

                                }
                                ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                            <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($cate_product as $key=>$catego_ry)
                                        <li><a href="{{\Illuminate\Support\Facades\URL::to('/danh-muc').'/'.$catego_ry->slug_category_product}}">{{$catego_ry->category_name}}</a></li>

                                    @endforeach

                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach($cate_post as $key=>$cate_posts)
                                        <li><a href="{{\Illuminate\Support\Facades\URL::to('/danh-muc-bai-viet').'/'.$cate_posts->cate_post_slug}}">{{$cate_posts->cate_post_name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <?php
                            $a = \Illuminate\Support\Facades\Session::get('number');
                            if(\Illuminate\Support\Facades\Session::get('number')>0)
                            {
                                ?>
                            <li id="count_cart"></li>
                                <?php

                            }
                            else{
                                ?>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <span class="badges" style="background: red;padding: 5px;border-radius: 10px;font-size: 14px;
                                                            font-weight: bold;color: #fff">0</span></a></li>
                                <?php
                            }
                            ?>
                            <li><a href="{{url('/lien-he')}}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <form method="post" action="{{\Illuminate\Support\Facades\URL::to('/tim-kiem')}}">
                        {{csrf_field()}}
                    <div class="search_box pull-right">
                        <input type="text"  name="keywords_submit" placeholder="Search"/>
                        <input type="submit" style="margin-top: 0;color: #666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        @php
                        $i = 0;
                        @endphp
                        @foreach($slide as $key=>$slider)
                            @php
                            $i++;
                            @endphp
                        <div class="item {{$i==1?'active':''}}">
                            <div class="col-sm-12">
                                <img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product').'/'.$slider->slider_image}}" width="100%" height="200px" class="girl img-responsive" alt="" />
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach($cate_product as $key =>$cate)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian">
                                      <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->slug_category_product}}">
                                          {{$cate->category_name}}
                                          <span class="badge pull-right"><i class="fa fa-plus"></i></span>

                                      </a>
                                    </a>
                                </h4>
                            </div>
                            <div id="{{$cate->slug_category_product}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        @foreach($category_product_pro as $key2=>$cate_pro)
                                            @if($cate_pro->category_parent==$cate->category_id)
                                                <li><a href="{{\Illuminate\Support\Facades\URL::to('/danhmucsanpham/').'/'.$cate_pro->slug_category_product}}">{{$cate_pro->category_name}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Thương hiệu sản phẩm</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($brand_product as $key =>$cate)
                                <li><a href="#"> <span class="pull-right">(50)</span>
                                        <a href="{{\Illuminate\Support\Facades\URL::to('/thuonghieusanpham/').'/'.$cate->brand_id}}">
                                        {{$cate->brand_name}}
                                        </a>
                                    </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!--/brands_products-->
                    <div class="brands_products">
                        <h2>Sản phẩm đã xem</h2>
                        <div class="brands-name">
                            <div id="row_wishlist2">
                            </div>
                        </div>
                    </div>
                    <div class="brands_products">
                        <h2>Sản phẩm yêu thích</h2>
                        <div class="brands-name">
                            <div id="row_wishlist">
                            </div>
                        </div>
                    </div>
{{--                    <div class="price-range"><!--price-range-->--}}
{{--                        <h2>Price Range</h2>--}}
{{--                        <div class="well text-center">--}}
{{--                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />--}}
{{--                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>--}}
{{--                        </div>--}}
{{--                    </div><!--/price-range-->--}}

                    <div class="shipping text-center"><!--shipping-->
                        <img src="public/frontend/images/shipping.jpg" alt="" />
                    </div><!--/shipping-->
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <label for="amount">Sắp xếp theo</label>--}}
{{--                <form>--}}
{{--                    @csrf--}}
{{--                    <select name="sort" id="sort" class="form-control">--}}
{{--                        <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=none">--Lọc theo--</option>--}}
{{--                        <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>--}}
{{--                        <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>--}}
{{--                        <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=kytu_az">Lọc theo tên từ A đến Z</option>--}}
{{--                        <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=kytu_za">Lọc theo tên từ Z đến A</option>--}}
{{--                    </select>--}}
{{--                </form>--}}
{{--            </div>--}}
            <div class="col-sm-9 padding-right">
                @if($check == true)
                    <label for="amount">Sắp xếp theo</label>
                    <form>
                        @csrf
                        <select name="sort" id="sort" class="form-control">
                            <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=none">--Lọc theo--</option>
                            <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
                            <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
                            <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=kytu_az">Lọc theo tên từ A đến Z</option>
                            <option value="{{\Illuminate\Support\Facades\Request::url()}}?sort_by=kytu_za">Lọc theo tên từ Z đến A</option>
                        </select>
                    </form>
                @endif

                @yield('content')
                    <?php
                    $page = \Illuminate\Support\Facades\Session::get('page_number');
                    $total_pages = isset($_GET['page_number']);
                    $num_results_on_page=5;
                        ?>
                    @if($giatri != 0)
                        <div class="pagination">
                            <a href="#">&laquo;</a>
                                <?php
                                $count=0;
                                $page_number = \Illuminate\Support\Facades\Session::get('page_number');
                                if(isset($_GET  ['pages']))
                                {
                                    $giatri = $_GET['pages'];

                                }
                            for($i=0;$i<$page_number;$i++)
                            {
                                $count++;
                                ?>
                            <a class="{{$giatri==$count?'active':''}}" href="{{\Illuminate\Support\Facades\Request::url()}}?pages=<?php echo $count?>">{{$count}}</a>
                                <?php
                            }
                                ?>
                            {{--                        <a href="#" class="active">2</a>--}}
                            <a href="#">&raquo;</a>
                        </div>
                    @endif


            </div>
                <div class="col-md-12">
                    <h3>Đối tác của chúng tôi</h3>
                    <div class="owl-carousel owl-theme">
                        @foreach($partner as $item =>$part)
                            <div class="item">
                                <p><img src="{{url('/public/upload/product/').'/'.$part->image}}" width="100%"> </p>
                                <h4>{{$part->name}}</h4></div>

                        @endforeach

                    </div>
                </div>
        </div>
    </div>
</section>


<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <img src="{{url('public/upload/product/326920267_930583068308564_7390932668560296925_n38.jpg')}}" width="120px" height="120px">
                        <h2><span>Gia linh kids</span>-shopper</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">


                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="public/frontend/images/map.png" alt="" />
                        <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Dịch vụ</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Hướng dẫn mua hàng</a></li>
                            <li><a href="#">Hướng dẫn thanh toán</a></li>
                            <li><a href="#">Quy định đối tác</a></li>
                            <li><a href="#">Điều khoản dịch vụ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Thông tin shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Địa chỉ: Trường Cao Đẳng Công nghệ Cao Hà Nội</a></li>
                            <li><a href="#">SĐT: 0912701259</a></li>
                            <li><a href="#">Email liên hệ: chuvannam832002@gmail.com</a></li>
                            <li><a href="https://www.facebook.com/chuvan.nam.56232">Facebook liên hệ: chuvannam@facebook.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Fanpage</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="https://www.facebook.com/profile.php?id=100092278142626">Link Fanpage</a></li>
                            <li><a href="https://ldp.page/62375f824d0f96001248a48a?fbclid=IwAR1PoppEORzUwayWIwHCXLHUlYFOt4kMmm34Kfbn5hlPMBMdbIGo8LGZtOQ">Website</a></li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 GIALINH-KIDS-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->



<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script src="{{asset('public/frontend/js/owl.carousel.js')}}"></script>
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery.sharrre.min.js')}}"></script>
<script src="{{asset('public/frontend/js/prettify.js')}}"></script>
<script src="{{asset('public/frontend/js/main.js')}}"></script>
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
{{--        <?php--}}
{{--            $a = \Illuminate\Support\Facades\Session::get('number');--}}
{{--            if(\Illuminate\Support\Facades\Session::get('number')>0)--}}
{{--            {--}}
{{--                ?>--}}
{{--        <?php--}}

{{--            }--}}
{{--            else{--}}
{{--                ?>--}}
{{--        count_cart();--}}
{{--        <?php--}}
{{--            }--}}
{{--            ?>--}}
        count_cart();
        function count_cart(){
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/count-cart')}}',
                method:'GET',
                success:function (data) {
                   $('#count_cart').html(data);
                   // window.location.reload();
                }
            })
        }
        function new_count_cart(){
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/new-count-cart')}}',
                method:'GET',
                success:function (data) {
                    $('#count_cart').html(data);
                }
            })
        }
        $('.add-to-cart').click(function () {
            var id = $(this).data('id');
            var cart_product_id = $('.cart_product_id_'+id).val();
            var cart_product_name = $('.cart_product_name_'+id).val();
            var cart_product_image = $('.cart_product_image_'+id).val();
            var cart_product_quantity = $('.cart_product_quantity_'+id).val();
            var cart_product_price = $('.cart_product_price_'+id).val();
            var cart_product_qty = $('.cart_product_qty_'+id).val();
            var _token = $('input[name="_token"]').val();
            if(parseInt(cart_product_qty)>parseInt(cart_product_quantity))
            {
                alert("Hàng tồn kho không đủ , Vui lòng đặt lại");
            }
            else{
                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price
                        ,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
                    success:function (){
                        new_count_cart();
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function(isConfirm) {
                            if(isConfirm)
                            {
                                window.location.href = "{{url('/gio-hang')}}";
                            }
                            else{
                                window.location.reload();
                            }
                            });

                    }
                })
            }

        })
        $('.send_order').click(function () {
            swal({
                title: "Xác nhận đơn hàng !",
                text: "Đơn hàng sẽ không hoàn trả khi đặt, bạn có muốn đặt hay không ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Xác nhận",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                function(isConfirm) {
                    if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_note = $('.shipping_note').val();
                        var order_coupon = $('.order_coupon').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: '{{\Illuminate\Support\Facades\URL::to('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone
                                ,shipping_note:shipping_note,order_coupon:order_coupon,order_fee:order_fee,_token:_token,shipping_method:shipping_method},
                            success:function (){
                                swal("Thông báo", "Đơn hàng của bạn đã được gửi thành công", "success");

                            },
                            error:function (){
                                swal("Thông báo", "Bạn cần điền đầy đủ thông tin để đặt đơn hàng", "error");
                            }
                        })
                    } else {
                        swal("Thông báo", "Đơn hàng chưa được gửi , vui lòng hoàn tất đơn đặt hàng", "error");
                    }
                });


        })
        $('.calculator_delivory').click(function () {
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var _token = $('input[name="_token"]').val();
            if(city==''&& province==''&&wards=='')
            {
                alert('Làm ơn chọn để tính phí vận chuyển');
            }
            else{
                $.ajax({
                    url:'{{\Illuminate\Support\Facades\URL::to('/calculator-fee')}}',
                    method:'POST',
                    data:{matp:city,maqh:province,xaid:wards,_token:_token},
                    success:function (data) {
                        location.reload();
                    }
                })
            }

        })
        $('.choose').on('change',function () {
            var action = $(this).attr('id');
            var matp = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action=='city'){
                result = 'province';
            }
            else{
                result = 'wards';
            }
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/select-delivery-home')}}',
                method:'POST',
                data:{action:action,matp:matp,_token:_token},
                success:function (data) {
                    $('#'+result).html(data);

                }
            })
        })
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop:true,
            slideMargin: 0,
            thumbItem: 6
        });
        $('.xemnhanh').click(function () {
            var product_id = $(this).data('id_product');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/quickview')}}',
                method:'POST',
                dataType:"JSON",
                data:{product_id:product_id,_token:_token},
                success:function (data) {
                    $('#product_quickview_title').html(data.product_name);
                    $('#product_quickview_id').html(data.product_id);
                    $('#product_quickview_price').html(data.product_price);
                    $('#product_quickview_image').html(data.product_image);
                    $('#product_quickview_gallery').html(data.product_gallery);
                    $('#product_quickview_desc').html(data.product_desc);
                    $('#product_quickview_content').html(data.product_content);
                    $('#product_quickview_value').html(data.product_quickview_value);
                    $(document).on('click','.add-to-cart-quickview',function () {
                        var cart_product_id = $('.cart_product_id_'+product_id).val();
                        var cart_product_name = $('.cart_product_name_'+product_id).val();
                        var cart_product_image = $('.cart_product_image_'+product_id).val();
                        var cart_product_quantity = $('.cart_product_quantity_'+product_id).val();
                        var cart_product_price = $('.cart_product_price_'+product_id).val();
                        var cart_product_qty = $('.cart_product_qty_'+product_id).val();
                        var _token = $('input[name="_token"]').val();
                        if(parseInt(cart_product_qty)>parseInt(cart_product_quantity))
                        {
                            alert("Hàng tồn kho không đủ , Vui lòng đặt lại");
                        }
                        else{
                            $.ajax({
                                url: '{{url('/add-cart-ajax')}}',
                                method: 'POST',
                                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price
                                    ,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
                                beforeSend:function () {
                                    $('#before_send').html("<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");
                                },
                                success:function (){

                                    $('#before_send').html("<p class='text text-success'>Đã thêm sản phẩm vào giỏ hàng</p>");
                                    $('#byquickview').attr('disabled',true);
                                    new_count_cart();
                                    window.location.reload();
                                }
                            })
                        }

                    })
                    $(document).on('click','.add-to-cart-quicksee',function () {
                        window.location.href = "http://localhost:8080/shopbanhang/chitietsanpham/"+product_id;
                    })
                }
            })
        })
        {{--$(document).on('click','.add-to-cart-quickview',function () {--}}
        {{--    var id = $(this).data('id');--}}
        {{--    var cart_product_id = $('.cart_product_id_'+id).val();--}}
        {{--    var cart_product_name = $('.cart_product_name_'+id).val();--}}
        {{--    var cart_product_image = $('.cart_product_image_'+id).val();--}}
        {{--    var cart_product_quantity = $('.cart_product_quantity_'+id).val();--}}
        {{--    var cart_product_price = $('.cart_product_price_'+id).val();--}}
        {{--    var cart_product_qty = $('.cart_product_qty_'+id).val();--}}
        {{--    var _token = $('input[name="_token"]').val();--}}
        {{--    if(parseInt(cart_product_qty)>parseInt(cart_product_quantity))--}}
        {{--    {--}}
        {{--        alert("Hàng tồn kho không đủ , Vui lòng đặt lại");--}}
        {{--    }--}}
        {{--    else{--}}
        {{--        $.ajax({--}}
        {{--            url: '{{url('/add-cart-ajax')}}',--}}
        {{--            method: 'POST',--}}
        {{--            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price--}}
        {{--                ,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},--}}
        {{--            beforeSend:function () {--}}
        {{--                $('#before_send').html("<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");--}}
        {{--            },--}}
        {{--            success:function (){--}}
        {{--                $('#before_send').html("<p class='text text-success'>Đã thêm sản phẩm vào giỏ hàng</p>");--}}
        {{--                $('#byquickview').attr('disabled',true);--}}
        {{--            }--}}
        {{--        })--}}
        {{--    }--}}

        {{--})--}}

        function load_comment() {
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/load-comment')}}',
                method:'POST',
                data:{product_id:product_id,_token:_token},
                success:function (data) {
                    $('#comment_show').html(data);
                }
            })
        }
        $('.send-comment').click(function () {
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/send-comment')}}',
                method:'POST',
                data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
                success:function (data) {
                 load_comment();
                 $('#notify-comment').html("<p class='text text-success'>Thêm bình luận thành công</p>")
                }
            })
        })
        load_comment();
        function remove_background(product_id) {
            for(var count = 1;count<=5;count++)
            {
                $('#'+product_id+'-'+count).css('color','#ccc');
            }
        }
        $(document).on('mouseleave','.rating',function () {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            // for(var count = 1;count<=5;count++)
            // {
            //     $('#'+product_id+'-'+count).css('color','#ccc');
            // }
            for(var count =1 ; count<=index;count++)
            {
                $('#'+product_id+'-'+count).css('color','#ffcc00');
            }
        })
        $(document).on('mouseenter','.rating',function () {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            for(var count = 1;count<=5;count++)
            {
                $('#'+product_id+'-'+count).css('color','#ccc');
            }
            for(var count =1 ; count<=index;count++)
            {
                $('#'+product_id+'-'+count).css('color','#ffcc00');
            }
        })
        $(document).on('click','.rating',function () {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            var id=0;
            <?php
                $check_id = \Illuminate\Support\Facades\Session::get('customer_id');
                if($check_id)
                {
                    ?>
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/insert-rating')}}',
                method:'POST',
                data:{product_id:product_id,index:index,_token:_token},
                success:function (data) {
                    if(data=='done')
                    {
                        swal("Thông báo", "Bạn đã đánh giá "+index+" trên 5 * sản phẩm này !", "success");
                    }
                    else{
                        swal("Thông báo", "Bạn đã đánh giá sản phẩm này !", "error");
                    }
                }
            })
            <?php
                }
                else{
                    ?>
                 swal("Thông báo", "Bạn cần đăng nhập để đánh giá", "error");
            swal({
                    title: "Thông báo",
                    text: "Bạn cần đăng nhập để đánh giá!",
                    type: "warning",
                    confirmButtonClass: "btn-danger",
                    cancelButtonText: "Ok",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location.href = "{{url('/checkout')}}";
                    }
                });
            <?php

                }
                ?>

        })
        $('.tabs_pro').click(function () {
            var cate_id = $(this).data('id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/product-tab')}}',
                method:'POST',
                data:{cate_id:cate_id,_token:_token},
                success:function (data) {
                    $('#tabs_product').html(data);
                }
            })
        })
        function view() {
            if(localStorage.getItem('data')!=null)
            {
                var data = JSON.parse(localStorage.getItem('data'));
                data.reverse();
                document.getElementById('row_wishlist').style.overflow='scroll';
                document.getElementById('row_wishlist').style.height='600px';
                for(var i=0;i<data.length;i++)
                {
                    var name = data[i].name;
                    var id = data[i].id;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_wishlist').append('<div class="row"><div class="col-md-4"><img width="100%" src="'+image+'"></div>' +
                        '<div class="col-md-8"><p>'+name+'</p><p style="color: #FE980F">'+price+' VNĐ</p>' +
                        '<a href="'+url+'">Đặt hàng</a><p><a data-id="'+id+'"class="btn btn-danger btn-xs delete_wishlist" >Xóa yêu thích</a></p></div>')
                }
            }
        }
        function view2() {
            if(localStorage.getItem('data2')!=null)
            {
                var data = JSON.parse(localStorage.getItem('data2'));
                data.reverse();
                document.getElementById('row_wishlist2').style.overflow='scroll';
                document.getElementById('row_wishlist2').style.height='600px';
                for(var i=0;i<data.length;i++)
                {
                    var name = data[i].name;
                    var id = data[i].id;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url = data[i].url;
                    $('#row_wishlist2').append('<div class="row"><div class="col-md-4"><img width="100%" src="'+image+'"></div>' +
                        '<div class="col-md-8"><p>'+name+'</p><p style="color: #FE980F">'+price+' VNĐ</p>' +
                        '<a href="'+url+'">Đặt hàng</a><p><a data-id="'+id+'"class="btn btn-danger btn-xs delete_wishlist2" >Xóa đã xem</a></p></div>')
                }
            }
        }
        view();
        view2();
        $(document).on('click','.delete_wishlist',function(event){
            event.preventDefault(); // những hành động mặc định của sự kiện sẽ k xảy ra
            var id = $(this).data('id');

            // console.log(localStorage.getItem('data'));
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));
                if (data.length) {
                    for (i = 0; i < data.length; i++) {
                        if (data[i].id == id) {
                            // alert(data[i].name);
                            data.splice(i,1); //xóa phần tử khỏi mảng, tham số thứ 2 là 1 phần tử
                        }
                    }
                }
                localStorage.setItem('data',JSON.stringify(data));  //chuyển obj->string
                alert('Xóa yêu thích thành công');
                window.location.reload();
            }
        });
        $(document).on('click','.delete_wishlist2',function(event){
            event.preventDefault(); // những hành động mặc định của sự kiện sẽ k xảy ra
            var id = $(this).data('id');
            // console.log(localStorage.getItem('data'));
            if (localStorage.getItem('data2') != null) {
                var data = JSON.parse(localStorage.getItem('data2'));
                if (data.length) {
                    for (i = 0; i < data.length; i++) {
                        if (data[i].id == id) {
                            // alert(data[i].name);
                            data.splice(i,1); //xóa phần tử khỏi mảng, tham số thứ 2 là 1 phần tử
                        }
                    }
                }
                localStorage.setItem('data2',JSON.stringify(data));  //chuyển obj->string
                alert('Xóa sản phẩm đã xem thành công');
                window.location.reload();
            }
        });
        $('#sort').on('change',function () {
            var url = $(this).val();
            if(url)
            {
                window.location=url;
            }
            return false;
        })
        $('.owl-carousel').owlCarousel({
            loop:true,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    })
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0" nonce="F4eNZT3Y"></script>
</body>
</html>
