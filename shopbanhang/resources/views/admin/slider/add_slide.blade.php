@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Banner
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
                    <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/save-slider')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slide</label>
                            <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh</label>
                            <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả </label>
                            <textarea style="resize: none" rows="8" class="form-control" name="slider_desc" id="exampleInputPassword1">
                        </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name="slider_status" class="form-control input-lg m-bot15">
                                <option value="1">Ẩn Slide</option>
                                <option value="0">Hiển thị Slide</option>
                            </select>
                        </div>
                        <button type="submit" name="add_slider" class="btn btn-info">Thêm Slide</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
@endsection
