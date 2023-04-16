@extends('welcome')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="register-req">
                <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại đơn hàng</p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8 clearfix">
                        <div class="bill-to">
                            <p>Thông tin gửi hàng</p>
                            <div class="form-one">
                                <form action="" method="post">
                                    {{csrf_field()}}
                                    <input type="text" name="shipping_email" class="shipping_email" placeholder="Email">
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                                    <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                                    <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                                    <textarea name="shipping_note" class="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
                                    @if(\Illuminate\Support\Facades\Session::get('fee'))
                                        <input type="hidden" name="order_fee" class="order_fee" value="{{\Illuminate\Support\Facades\Session::get('fee')}}">
                                    @else
                                        <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                    @endif
                                    @if(\Illuminate\Support\Facades\Session::get('coupon'))
                                        @foreach(\Illuminate\Support\Facades\Session::get('coupon') as $key=>$cou)
                                            <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="Không có">
                                    @endif
                                        <select name="payment_select" class="form-control input-lg m-bot15 payment_select">
                                            <option value="1">Qua chuyển khoản</option>
                                            <option value="2">Thanh toán bằng tiền mặt</option>
                                        </select>
                                        <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
                                </form>
                                <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/insert-coupon-code')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn thành phố</label>
                                        <select name="city" id="city" class="form-control input-lg m-bot15 choose city">
                                            <option value="0">----Chọn tỉnh thành phố----</option>
                                            @foreach($city as $key=>$ci)
                                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                            @endforeach
                                        </select>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                                        <select name="province" id="province" class="form-control input-lg m-bot15 choose province">
                                            <option value="0">----Chọn quận huyện----</option>

                                        </select>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn xã phường</label>
                                        <select name="wards" id="wards" class="form-control input-lg m-bot15 wards">
                                            <option value="0">----Chọn xã phường----</option>

                                        </select>
                                        </textarea>
                                    </div>

                                </form>
                                <input type="button" value="Tính phí vận chuyển " name="calculator_order" class="btn btn-primary btn-sm calculator_delivory">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 clearfix">
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">

                                <thead>

                                <tr class="cart_menu">
                                    <td class="image">Sản phẩm</td>
                                    <td class="description">Mô tả</td>
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
                                @if($data==true
                                )
                                    <form action="{{\Illuminate\Support\Facades\URL::to('/update-cart')}}" method="post">

                                    @foreach($data as $key=> $v_content)
                                        @php
                                            $subtotal = $v_content['product_price']*$v_content['product_qty'];
                                            $total+=$subtotal;
                                        @endphp
                                        <tr>
                                                {{csrf_field()}}
                                                <td class="cart_product">
                                                    <a href=""><img src="{{asset('public/upload/product/'.$v_content['cart_product_image'])}}"
                                                                    width="100" height="100" alt=""></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h4><a href=""></a></h4>
                                                    <p>{{$v_content['product_name']}}</p>
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
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out">
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
                                            <li>Tổng tiền: <span>{{$total}} đ</span></li>
                                            @if(\Illuminate\Support\Facades\Session::get('coupon'))
                                                @foreach(\Illuminate\Support\Facades\Session::get('coupon') as $key=>$item)
                                                    <li>
                                                        @if($item['coupon_condition']==1)
                                                            Mã giảm: {{$item['coupon_number']}} %
                                                            <p>
                                                                @php
                                                                    $total_coupon = ($total*$item['coupon_number'])/100;
                                                                    echo '<p><li>Tổng giảm: '.number_format($total_coupon,0,',','.').' đ</li></p>';
                                                                @endphp
                                                            </p>
                                                            <p>
                                                                @php
                                                                    $total_after_coupon = $total-$total_coupon;
                                                                @endphp
                                                            </p>
                                                        @else
                                                            Mã giảm: {{$item['coupon_number']}} $
                                                            <p>
                                                                @php
                                                                    $total_coupon = ($total-$item['coupon_number']);
                                                                    echo '<p><li>Tổng giảm: '.number_format($total_coupon,0,',','.').'đ</li></p>';
                                                                @endphp
                                                            </p>
                                                            <p>
                                                                @php
                                                                    $total_after_coupon = $total_coupon;
                                                                @endphp
                                                            </p>
                                                        @endif
                                                    </li>

                                                @endforeach
                                            @endif
                                            {{--                                        <li>Thuế: <span></span></li>--}}
                                            @if(\Illuminate\Support\Facades\Session::get('fee'))
                                                <li><a class="cart_quantity_delete" href="{{\Illuminate\Support\Facades\URL::to('/del-fee')}}">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                    Phí vận chuyển: <span>{{number_format(\Illuminate\Support\Facades\Session::get('fee'),0,',','.')}}đ</span></li>
                                                @php
                                                    $total_after_fee = $total + \Illuminate\Support\Facades\Session::get('fee');
                                                @endphp
                                            @endif
                                            <li>Tổng còn:
                                                @php
                                                    if(\Illuminate\Support\Facades\Session::get('fee')&&!\Illuminate\Support\Facades\Session::get('coupon'))
                                                        {
                                                            $total_after = $total_after_fee;
                                                            echo number_format($total_after,0,',','.');
                                                        }elseif (!\Illuminate\Support\Facades\Session::get('fee')&&\Illuminate\Support\Facades\Session::get('coupon'))
                                                    {
                                                         $total_after = $total_after_coupon;echo number_format($total_after,0,',','.');
                                                    }elseif (\Illuminate\Support\Facades\Session::get('fee')&&\Illuminate\Support\Facades\Session::get('coupon')){
                                                            $total_after = $total- Illuminate\Support\Facades\Session::get('fee');
                                                            $total_after = $total_after-$total_coupon;
                                                            ;echo number_format($total_after,0,',','.');
                                                    }else{
                                                        $total_after = $total;
                                                        echo number_format($total_after,0,',','.');
                                                    }
                                                @endphp
                                                {{--                                        <li>Phí vận chuyển: <span>Free</span></li>--}}
                                                đ</li>
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
                                    </form>

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

                </div>
            </div>

        </div>
    </section> <!--/#cart_items-->

@endsection
