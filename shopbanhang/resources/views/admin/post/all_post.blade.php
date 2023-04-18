@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê bài viết
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
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên  bài viết</th>
                        <th>Hình ảnh</th>
                        <th>Slug</th>
                        <th>Mô tả  bài viết</th>
                        <th>Từ khóa  bài viết</th>
                        <th>Danh mục bài viết</th>
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category_product as $key =>$cate_pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$cate_pro->post_title}}</td>
                        <td><img src="{{\Illuminate\Support\Facades\URL::to('/public/upload/product').'/'.$cate_pro->post_image}}" height="100" width="100"></td>
                        <td>{{$cate_pro->post_slug }}</td>
                        <td>{{$cate_pro->post_desc}}</td>
                        <td>{{$cate_pro->post_meta_keywords}}</td>
                        <td>{{$cate_pro->cate_post_id}}</td>
                        <td>
                            @if($cate_pro->post_status==0)
                                Hiển thị
                            @else
                                Ẩn
                            @endif
                        </td>
                        <td>
{{--                            <a href="{{\Illuminate\Support\Facades\URL::to('/edit-post/').'/'.$cate_pro->post_id}}" style="font-size: 20px" class="active" ui-toggle-class="">--}}
{{--                                <i class="fa fa-pencil-square-o text-success text-active"></i>--}}
{{--                            </a>--}}
                            <a onclick="return confirm('Are you sure to delete this writting?')" href="{{\Illuminate\Support\Facades\URL::to('/delete-post/').'/'.$cate_pro->post_id}}" style="font-size: 20px" class="active" ui-toggle-class="">
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
