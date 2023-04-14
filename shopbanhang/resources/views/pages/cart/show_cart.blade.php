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
                <?php
                    $content = \Gloudemans\Shoppingcart\Facades\Cart::content();
                ?>
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
                    @foreach($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product/').'/'.$v_content->options->image}}"
                                            width="100" height="100" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                            <p>Mã ID: {{$v_content->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).'VNĐ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{\Illuminate\Support\Facades\URL::to('/update-cart-quantity')}}" method="post">
                                    {{csrf_field()}}
                                <input class="cart_quantity_input" type="number" name="cart_quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
                                <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
                                <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $v_content->price * $v_content->qty;
                                    echo number_format($subtotal)."VNĐ"
        ?>></p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{\Illuminate\Support\Facades\URL::to('/delete-to-cart/').'/'.$v_content->rowId}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach

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
                        <ul>
                            <li>Tổng <span>{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</span></li>
                            <li>Thuế <span>{{\Gloudemans\Shoppingcart\Facades\Cart::tax()}}</span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>Thành tiền <span>{{\Gloudemans\Shoppingcart\Facades\Cart::total()}}</span></li>
                        </ul>
                        <?php
                        $customer_id = \Illuminate\Support\Facades\Session::get('customer_id');
                        if($customer_id=NULL)
                        {
                            ?>
                        <a class="btn btn-default check_out" href="{{\Illuminate\Support\Facades\URL::to('login-checkout')}}">Thanh toán</a>
                            <?php
                        }else{
                            ?>
                        <a class="btn btn-default check_out" href="{{\Illuminate\Support\Facades\URL::to('checkout')}}">Thanh toán</a>
                            <?php

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
