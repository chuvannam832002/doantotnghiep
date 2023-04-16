@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin người mua
            </div>

            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$customer->customer_name}}</td>
                            <td>{{$customer->customer_email}}</td>
                            <td>{{$customer->customer_phone}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
            </div>

            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Tên người vận chuyển</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                        <th>Hình thức thanh toán</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$shipping->shipping_name}}</td>
                        <td>{{$shipping->shipping_address}}</td>
                        <td>{{$shipping->shipping_phone}}</td>
                        <td>{{$shipping->shipping_email}}</td>
                        <td>{{$shipping->shipping_note}}</td>
                        <td>@if($shipping->shipping_method==1)
                                Chuyển khoản
                            @else
                                Tiền mặt
                        @endif</td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>

            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Số thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng</th>
                        <th>Giá </th>
                        <th>Tổng tiền</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i = 0 ;
                    $total=0;
                    @endphp
                    @foreach($order_detail_new as $key=>$order_detail)
                        @php
                        $i++;
                        $subtotal = $order_detail->product_price*$order_detail->product_sales_quantity;
                        $total+=$subtotal;
                        @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$order_detail->product_name}}</td>
                        <td>@if($order_detail->product_coupon!='no')
                                {{$order_detail->product_coupon}}
                            @else
                                Không mã
                        @endif</td>
                        <td>{{$order_detail->product_sales_quantity}}</td>
                        <td>{{number_format($order_detail->product_price,0,',','.')}} đ</td>
                        <td>{{number_format($order_detail->product_price*$order_detail->product_sales_quantity,0,',','.')}} đ</td>

                    </tr>
                    @endforeach
                    <tr><td colspan="6">
                            @php
                            $total_coupon = 0;
                            @endphp

                                @if($coupon_condition==1 && $coupon_number)
                                    @php
                                    $total_after_coupon = ($total * $coupon_number)/100;
                                    echo 'Tổng giảm:'.$coupon_number.' đ</br>';
                                    $total_coupon=$total-$total_after_coupon;
                                        @endphp
                            @else
                                @php
                                    echo 'Tổng giảm:'.$coupon_number.' đ</br>';
                                    $total_coupon=$total-$coupon_number;
                                @endphp
                                @endif
                            Thành tiền: {{number_format($total_coupon,0,',','.')}} đ
                        </td></tr>
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
