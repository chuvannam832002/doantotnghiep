@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm vận chuyển
            </header>
            <?php
            $message=\Illuminate\Support\Facades\Session::get('message');
            if($message)
            {
                echo '<span class="text-alert" style=" color:red;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;">'.$message.'</span>';
                \Illuminate\Support\Facades\Session::put('message',null);
            }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/insert-coupon-code')}}" method="post">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn thành phố</label>
                            <select name="city" id="city" class="form-control input-lg m-bot15">
                                <option value="0">----Chọn tỉnh thành phố----</option>
                                @foreach($city as $key=>$ci)
                                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                @endforeach
                            </select>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn quận huyện</label>
                            <select name="province" id="province" class="form-control input-lg m-bot15">
                                <option value="0">----Chọn quận huyện----</option>
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn xã phường</label>
                            <select name="wards" id="wards" class="form-control input-lg m-bot15">
                                <option value="0">----Chọn xã phường----</option>
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phí vận chuyển</label>
                            <input type="text" name="fee_ship" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <button type="button" name="add-delivory" id="add-delivory" class="btn btn-info">Thêm phí vận chuyển</button>
                    </form>
                </div>

            </div>
        </section>

    </div>


@endsection
