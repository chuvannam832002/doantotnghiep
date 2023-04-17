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
                        <th>Số lượng sản phẩm tồn kho</th>
                        <th>Mã giảm giá</th>
                        <th>Phí ship hàng</th>
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
                    <tr class="color_qty_{{$order_detail->product_id}}">
                        <td>{{$i}}</td>
                        <td>{{$order_detail->product_name}}</td>
                        <td>{{$order_detail->product->product_quantity}}</td>
                        <td>@if($order_detail->product_coupon!='no')
                                {{$order_detail->product_coupon}}
                            @else
                                Không mã
                        @endif</td>
                        <td>{{$order_detail->product_feeship}}</td>
                        <td>
                            <input type="number" min="1" {{$order_status==2?'disabled':''}} class="order_qty_{{$order_detail->product_id}}" value="{{$order_detail->product_sales_quantity}}" name="product_sales_quantity">
                            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$order_detail->product_id}}"
                                   value="{{$order_detail->product->product_quantity}}">
                            <input type="hidden" name="order_qty_sold" class="order_qty_sold_{{$order_detail->product_id}}"
                                   value="{{$order_detail->product->product_sold}}">
                            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$order_detail->product_id}}">
                            <input type="hidden" name="order_detail_product_id" class="order_detail_product_id" value="{{$order_detail->order_details_id}}">
                            <input type="hidden" name="order_product_code" class="order_product_code" value="{{$order_detail->order_code}}">
                            @if($order_status!=2)
                                <button class="btn btn-default update_quantity_order" data-product_id="{{$order_detail->product_id}}" name="update_quantity_order">Cập nhật</button> </td>

                            @endif
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
                    <tr>
                        <td colspan="6">
                            @foreach($order as $key =>$or)
                                @csrf
                                @if($or->order_status==1)
                                    <select class="form-control order_orderdetails">
                                        <option value="">----Chọn hình thức đơn hàng----</option>
                                        <option id="{{$or->order_id}}" selected value="1">Chưa xử lý </option>
                                        <option  id="{{$or->order_id}}" value="2">Đã xử lý - Đã giao hàng</option>
                                        <option id="{{$or->order_id}}" value="3">Hủy đơn hàng - tạm giữ</option>
                                    </select>
                                @elseif($or->order_status==2)
                                    <select class="form-control order_orderdetails">
                                        <option value="">----Chọn hình thức đơn hàng----</option>
                                        <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                        <option id="{{$or->order_id}}" selected value="2">Đã xử lý - Đã giao hàng</option>
                                        <option id="{{$or->order_id}}"value="3">Hủy đơn hàng - tạm giữ</option>
                                    </select>
                                @else
                                    <select class="form-control order_orderdetails">
                                        <option value="">----Chọn hình thức đơn hàng----</option>
                                        <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                        <option id="{{$or->order_id}}" value="2">Đã xử lý - Đã giao hàng</option>
                                        <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng - tạm giữ</option>
                                    </select>
                                @endif

                            @endforeach
                        </td>
                    </tr>
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
