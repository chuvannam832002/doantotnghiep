@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục bài viết
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
                    <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/update-cate_post/').'/'.$cate_post->cate_post_id}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục bài viết</label>
                            <input type="text" value="{{$cate_post->cate_post_name}}" name="cate_post_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{$cate_post->cate_post_slug}}" name="cate_post_slug" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="cate_post_desc" id="exampleInputPassword1">{{$cate_post->cate_post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ẩn/ Hiện</label>
                            <select name="cate_post_status" class="form-control input-lg m-bot15">
                                @if($cate_post->cate_post_status==0)
                                    <option value="1">Ẩn</option>
                                    <option selected value="0">Hiển thị</option>
                                @else
                                    <option selected value="1">Ẩn</option>
                                    <option  value="0">Hiển thị</option>
                                @endif

                            </select>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật bài viết</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
@endsection
