@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
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
                    <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/save-brand-product')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_product_name" required class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" rows="8" required class="form-control" name="brand_product_desc" id="exampleInputPassword1">
                        </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name="brand_product_status" class="form-control input-lg m-bot15">
                                <option value="1">Ẩn</option>
                                <option value="0">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
@endsection
