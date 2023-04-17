@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm sản phẩm
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
                <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" name="product_name" required class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                        <input type="text" name="product_quantity" required class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="text" name="product_price" required class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                        <input type="file" name="product_image" required class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea style="resize: none" rows="8" required class="form-control" name="product_desc" id="exampleInputPassword1">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea style="resize: none" rows="8" required class="form-control" name="product_content" id="exampleInputPassword1">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Danh mục sản phẩm</label>
                        <select name="product_category" required class="form-control input-lg m-bot15">
                            @foreach($cate_product as $key =>$cate_pro)
                            <option value="{{$cate_pro->category_id}}">{{$cate_pro->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Thương hiệu sản phẩm</label>
                        <select name="product_brand"  class="form-control input-lg m-bot15">
                            @foreach($brand_product as $key =>$cate_pro)
                                <option value="{{$cate_pro->brand_id}}">{{$cate_pro->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Ẩn/ Hiện</label>
                        <select name="product_status" class="form-control input-lg m-bot15">
                            <option value="1">Ẩn</option>
                            <option value="0">Hiển thị</option>
                        </select>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                </form>
            </div>

        </div>
    </section>

</div>
@endsection
