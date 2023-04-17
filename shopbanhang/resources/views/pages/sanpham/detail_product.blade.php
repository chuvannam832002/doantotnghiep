@extends('welcome')
@section('content')
    @foreach($product_details as $key=>$pro)
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product/').'/'.$pro->product_image}}" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
                        </div>

                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
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
                    <li class="active"><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
                    <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details" >
                    <p>{{$pro->product_des}}</p>
                </div>

                <div class="tab-pane fade" id="companyprofile" >
                    <p>{{$pro->product_content}}</p>
                </div>


                <div class="tab-pane fade " id="reviews" >
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
                            <textarea name="" ></textarea>
                            <b>Rating: </b> <img src="{{\Illuminate\Support\Facades\URL::to('/public/frontend/images/rating.png')}}" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->
    @endforeach
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
