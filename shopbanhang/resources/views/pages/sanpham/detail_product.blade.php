@extends('welcome')
@section('content')
        <div class="product-details"><!--product-details-->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: none">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/danhmucsanpham').'/'.$category_id}}">{{$category_name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
                </ol>
            </nav>
            <div class="col-sm-5">
                <div class="demo">
                    <ul id="lightSlider">
                        @foreach($gallery as $key2=>$all)
                            <li data-thumb="{{asset('public/upload/product').'/'.$all->gallery_image}}">
                                <img width="80%" height="auto" src="{{asset('public/upload/product/').'/'.$all->gallery_image}}">
                            </li>
                        @endforeach


                    </ul>
                </div>


            </div>
            @foreach($product_details as $key=>$pro)

            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
                    <h2>{{$pro->product_name}}</h2>
                    <p>Mã ID: {{$pro->product_id}}</p>
                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/rating.png')}}" alt="" />
                    <form method="post" action="{{\Illuminate\Support\Facades\URL::to('/save-cart')}}">
                        {{csrf_field()}}
                        <span>
									<span>{{number_format($pro->product_price).'VNĐ'}}</span>
									<label>Số lượng:</label>
					 <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                        <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                <input type="number" name="qty" value="1" min="1" class="cart_product_qty_{{$pro->product_id}}">
                	<input type="hidden"  class="cart_product_quantity_{{$pro->product_id}}" value="{{$pro->product_quantity}}" />
									<button type="button" data-id="{{$pro->product_id}}" class="btn btn-primary btn-sm add-to-cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
								</span>
                        <p><b>Tình trạng:</b>Còn hàng</p>
                        <p><b>Điều kiện:</b> Mới 100%</p>
                        <p><b>Thương hiệu:</b>{{$pro->brand_name}}</p>
                        <p><b>Danh mục:</b>{{$pro->category_name}}</p>
                    </form>
                    <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->
        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li ><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                    <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="details" >
                    <p>{{$pro->product_des}}</p>
                </div>

                <div class="tab-pane fade" id="companyprofile" >
                    <p>{{$pro->product_content}}</p>
                </div>


                <div class="tab-pane fade active in " id="reviews" >
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <style type="text/css">
                            .style_comment{
                                border: 1px solid #ddd;
                                border-radius: 10px;
                                background: #F0F0E9;
                            }
                        </style>
                        <form>
                            @csrf
                            <div id="comment_show"></div>
                                                            <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$pro->product_id}}">

                        </form>
                        <p><b>Viết đánh giá của bạn</b></p>

                        <form action="#">
                            @csrf
										<span>
                                                                                                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$pro->product_id}}">
											<input style="width: 100%;margin-left: 0px" type="text" class="comment_name" placeholder="Tên"/>
										</span>
                            <textarea name="comment" class="comment_content" placeholder="Nội dung"></textarea>
                            <b>Đánh giá sao: </b> <img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/rating.png')}}" alt="" />
                            <button type="button" class="btn btn-default pull-right send-comment">
                                Gửi bình luận
                            </button>
                            <div id="notify-comment"></div>
                        </form>
                    </div>
                </div>

            </div>
            @endforeach

        </div><!--/category-tab-->
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Sản phẩm liên quan</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach($relate as $key=>$lienquan)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product/').'/'.$lienquan->product_image}}" width="200" height="230" alt="" />
                                        <h2>{{number_format($lienquan->product_price).'VNĐ'}}</h2>
                                        <p>{{$lienquan->product_name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="item">
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/recommend1.jpg')}}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/recommend2.jpg')}}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/recommend3.jpg')}}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->
@endsection
