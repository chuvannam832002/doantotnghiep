@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục bài viết
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
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên danh mục bài viết</th>
                        <th>Mô tả danh mục bài viết</th>
                        <th>Slug</th>
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category_product as $key =>$cate_pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$cate_pro->cate_post_name}}</td>
                        <td>{{$cate_pro->cate_post_desc }}</td>
                        <td>{{$cate_pro->cate_post_slug}}</td>
                        <td>
                            @if($cate_pro->cate_post_status==0)
                                Hiển thị
                            @else
                                Ẩn
                            @endif
                        </td>
                        <td>
                            <a href="{{\Illuminate\Support\Facades\URL::to('/edit-category-post/').'/'.$cate_pro->cate_post_id}}" style="font-size: 20px" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Are you sure to delete this topic?')" href="{{\Illuminate\Support\Facades\URL::to('/delete-category-post/').'/'.$cate_pro->cate_post_id}}" style="font-size: 20px" class="active" ui-toggle-class="">
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
