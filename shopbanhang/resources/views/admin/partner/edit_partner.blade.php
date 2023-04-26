@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật đối tác
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
                    <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/update-partner').'/'.$partner->icon_id}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên đối tác</label>
                            <input type="text" name="name" class="form-control" value="{{$partner->name}}" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="file" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            <img src="{{url('public/upload/product/').'/'.$partner->image}}" width="120" height="120">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Link</label>
                            <textarea style="resize: none" rows="8" class="form-control" value="" name="link" id="exampleInputPassword1">{{$partner->link}}</textarea>
                        </div>
                        <button type="submit" name="add_slider" class="btn btn-info">Thêm đối tác</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
@endsection
