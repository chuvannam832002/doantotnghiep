@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật bài viết
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
                    <form role="form" action="{{\Illuminate\Support\Facades\URL::to('/update-post').'/'.$post->post_id}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_title" required class="form-control" value="{{$post->post_title}}" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" required class="form-control" value="{{$post->post_slug}}" id="exampleInputEmail1" placeholder="Slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea style="resize: none" rows="8" required class="form-control" name="post_desc" id="exampleInputPassword1">{{$post->post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize: none" rows="8" required class="form-control" name="post_content" id="exampleInputPassword1">{{$post->post_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta từ khóa</label>
                            <textarea style="resize: none" rows="8" required class="form-control"  name="post_meta_keywords" id="exampleInputPassword1">{{$post->post_meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta nội dung</label>
                            <textarea style="resize: none" rows="8" required class="form-control" name="post_meta_desc" id="exampleInputPassword1">{{$post->post_meta_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh  bài viết</label>
                            <input type="file" name="post_image"  class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            <img width="120" height="120" src="{{url('/public/upload/product/').'/'.$post->post_image}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục bài viết</label>
                            <select name="cate_post_id" class="form-control input-lg m-bot15">
                                @foreach($category_product as $key=>$cate)
                                    <option {{$post->cate_post_id==$cate->cate_post_id? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name="post_status" class="form-control input-lg m-bot15">
                                @if($post->post_status==0)
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
