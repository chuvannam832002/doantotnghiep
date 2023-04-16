@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê mã giảm giá
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
