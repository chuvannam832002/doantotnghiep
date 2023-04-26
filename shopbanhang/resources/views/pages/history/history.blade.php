@extends('welcome')
@section('content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê tất cả đơn hàng
            </div>

            <?php
            $message=\Illuminate\Support\Facades\Session::get('message');
            if($message)
            {
                echo '<span class="text-alert" style=" color:red;
    font-size: 17px;
    width: 100%;
    margin-left:20px;
    text-align: center;
    font-weight: bold;">'.$message.'</span>';
                \Illuminate\Support\Facades\Session::put('message',null);
            }
            ?>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>

                        <th>Thứ tự</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày tháng đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=0;
                    @endphp
                    @foreach($getorder as $key =>$cate_pro)
                        @php
                        $i++;
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$cate_pro->order_code}}</td>
                            <td>{{$cate_pro->created_at}}</td>
                            <td>
                                @if($cate_pro->order_status==1)
                                    Đơn hàng mới
                                @else
                                    Đã xử lý - Đã giao hàng
                                @endif
                            </td>
                            {{--                            <td>{{$cate_pro->order_status}}</td>--}}
                            <td>
                                <a href="{{\Illuminate\Support\Facades\URL::to('/view-history-order/').'/'.$cate_pro->order_code}}" style="font-size: 20px" class="active" ui-toggle-class="">
                                    <i class="fa fa-eye text-success text-active"></i>
                                </a>
{{--                                <a onclick="return confirm('Are you sure to delete this row?')" href="{{\Illuminate\Support\Facades\URL::to('/delete-order/').'/'.$cate_pro->order_id}}" style="font-size: 20px" class="active" ui-toggle-class="">--}}
{{--                                    <i class="fa fa-times text-danger text"></i></a>--}}
                            </td>
                        </tr>
                    @endforeach
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
