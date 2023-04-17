@extends('welcome')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{\Illuminate\Support\Facades\URL::to('/')}}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
              @if(session()->has('message'))
                  <div class="alert alert-success">
                      {{session()->get('message')}}
                  </div>
                @elseif(session()->has('error'))
                  <div class="alert alert-danger">
                      {{session()->get('error')}}
                  </div>
              @endif

                <table class="table table-condensed">

                    <thead>

                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="description">Số lượng tồn</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $data = \Illuminate\Support\Facades\Session::get('newcart');
                    $total = 0;
                    @endphp
                    @if($data==true)
                        @foreach($data as $key=> $v_content)
                            @php
                            $subtotal = $v_content['product_price']*$v_content['product_qty'];
                            $total+=$subtotal;
                            @endphp
                            <tr>
                                <form action="{{\Illuminate\Support\Facades\URL::to('/update-cart')}}" method="post">
                                    {{csrf_field()}}
                                    <td class="cart_product">
                                        <a href=""><img src="{{asset('public/upload/product/'.$v_content['cart_product_image'])}}"
                                                        width="100" height="100" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href=""></a></h4>
                                        <p>{{$v_content['product_name']}}</p>
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href=""></a></h4>
                                        <p>{{$v_content['product_quantity']}}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{number_format($v_content['product_price'],0,',','.')}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            {{csrf_field()}}
                                            <input class="cart_quantity_input" type="number" min="1" name="cart_quantity[{{$v_content['session_id']}}]" value="{{$v_content['product_qty']}}" autocomplete="off" size="2">
                                            <input type="hidden" value="" name="rowId_cart" class="form-control">

                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{number_format($subtotal,0,',','.')}}
                                        </p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" href="{{\Illuminate\Support\Facades\URL::to('/delete-sp').'/'.$v_content['session_id']}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                            <tr>
                                <td>
                                    <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out">
                                </td>
                                <td>
                                    <a class="btn btn-default check_out" href="{{\Illuminate\Support\Facades\URL::to('/checkout')}}">Thanh toán</a>
                                </td>

                                <td>
                                    <a class="btn btn-default check_out" href="{{\Illuminate\Support\Facades\URL::to('/del-all-product')}}">Xóa tất cả</a>

                                </td>
                                @if(\Illuminate\Support\Facades\Session::get('coupon'))
                                    <td>
                                        <a class="btn btn-default check_out" href="{{\Illuminate\Support\Facades\URL::to('/del-all-coupon')}}">Xóa mã khuyến mãi</a>
                                    </td>
                                @endif
                                <td>
                                    <a class="btn btn-default check_out" href="{{\Illuminate\Support\Facades\URL::to('/checkout')}}">Đặt hàng</a>
                                </td>
                                <td>
                                        <li>Tổng tiền: <span>{{$total}}</span></li>
                                        @if(\Illuminate\Support\Facades\Session::get('coupon'))
                                            @foreach(\Illuminate\Support\Facades\Session::get('coupon') as $key=>$item)
                                                <li>
                                                @if($item['coupon_condition']==1)
                                                        Mã giảm: {{$item['coupon_number']}} %
                                                    <p>
                                                        @php
                                                        $total_coupon = ($total*$item['coupon_number'])/100;
                                                        @endphp
                                                    </p>
                                                    <p>
                                                        <li>Thành tiền: {{number_format($total-$total_coupon,0,',','.')}}</li></p>
                                                @else
                                                Mã giảm: {{$item['coupon_number']}} $
                                                <p>
                                                    @php
                                                        $total_coupon = ($total-$item['coupon_number']);
                                                    @endphp
                                                </p>
                                                <p><li>
                                            Thành tiền: {{number_format($total_coupon,0,',','.')}}
                                        </li></p>
                                                @endif
                                                </li>

                                        @endforeach
                                        @endif
{{--                                        <li>Thuế: <span></span></li>--}}
{{--                                        <li>Phí vận chuyển: <span>Free</span></li>--}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <form method="post" action="{{\Illuminate\Support\Facades\URL::to('/check-coupon')}}">
                                        {{csrf_field()}}
                                        <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                                        <input type="submit" name="check_coupon" value="Tính mã giảm giá" class="btn btn-default check_coupon">
                                    </form>
                                </td>
                            </tr>
                    @else
                        <tr>
                            <td>
                                @php
                                echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
                                @endphp
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </section> <!--/#cart_items-->
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">

                <div class="col-sm-6">
                    <div class="total_area">
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
