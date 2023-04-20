@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê mã giảm giá
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
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                    <tr>

                        <th>Tên mã</th>
                        <th>Mã giảm giá</th>
                        <th>Điều kiện giảm giá</th>
                        <th>Số lượng mã</th>
                        <th>Số giảm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupon as $key =>$cate_pro)
                        <tr>
                            <td>{{$cate_pro->coupon_name}}</td>
                            <td>{{$cate_pro->coupon_code}}</td>
                            <td>{{$cate_pro->coupon_time}}</td>
                            <td><span class="text-ellipsis">
                                <?php
                                    if($cate_pro->coupon_condition==1)
                                    {
                                        ?>
                                        Giảm theo %
                                <?php
                                    }
                                    else{
                                        ?>
                                        Giảm theo $
                                <?php
                                    }
                                        ?>
                            </span></td>
                            <td><span class="text-ellipsis">
                                <?php
                                    if($cate_pro->coupon_condition==1)
                                    {
                                        ?>
                                        Giảm {{$cate_pro->coupon_number}} %
                                <?php
                                    }
                                    else{
                                        ?>
                                        Giảm {{$cate_pro->coupon_number}} $
                                <?php
                                    }
                                        ?>
                            </span></td>
                            <td>

                                <a onclick="return confirm('Are you sure to delete this row?')" href="{{\Illuminate\Support\Facades\URL::to('/delete-coupon/').'/'.$cate_pro->coupon_id}}" style="font-size: 20px" class="active" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i></a>
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
