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
                    <div class="col-sm-5 clearfix">
                        <div class="bill-to">
                            <p>Thông tin gửi hàng</p>
                            <div class="form-one">
                                <form action="{{\Illuminate\Support\Facades\URL::to('/save-checkout-customer')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="text" name="shipping_email" placeholder="Email">
                                    <input type="text" name="shipping_name" placeholder="Họ và tên">
                                    <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                    <input type="text" name="shipping_phone" placeholder="Số điện thoại">
                                    <textarea name="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="8"></textarea>
                                    <input type="submit" value="Gửi" name="update_qty" class="btn btn-primary btn-sm">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
            </div>

            <div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
                <span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
                <span>
						<label><input type="checkbox"> Paypal</label>
					</span>
            </div>
        </div>
    </section> <!--/#cart_items-->

@endsection
