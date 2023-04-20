@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục sản phẩm
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
                        <th>Tên danh mục</th>
                        <th>Thuộc danh mục</th>
                        <th>SLug</th>
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_category_product as $key =>$cate_pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$cate_pro->category_name}}</td>
                        <td>
                            @if($cate_pro->category_parent==0)
                                <span style="color: red">Danh mục cha</span>
                            @else
                                @foreach($category_product as $key2 =>$cate_sub_pro)
                                   @if( $cate_sub_pro->category_id==$cate_pro->category_parent)
                                            <span style="color: green">{{$cate_sub_pro->category_name}}</span>
                                   @endif
                                @endforeach
                            @endif
                        </td>
                        <td>{{$cate_pro->slug_category_product}}</td>
                        <td><span >
                                <?php
                                    if($cate_pro->category_status==0)
                                    {
                                        ?>
                                        <a href="{{\Illuminate\Support\Facades\URL::to('/active-category-product/').'/'.$cate_pro->category_id}}"><span class="fa-thump-styling fa fa-thumbs-up" style="font-size:28px;color:green"></span></a>;
                                <?php
                                    }
                                    else{
                                        ?>
                                        <a href="{{\Illuminate\Support\Facades\URL::to('/unactive-category-product/').'/'.$cate_pro->category_id}}"><span class="fa-thump-styling fa fa-thumbs-down" style="font-size:28px;color:red"></span></a>;
                                <?php
                                    }
?>


                            </span></td>
                        <td>
                            <a href="{{\Illuminate\Support\Facades\URL::to('/edit-category-product/').'/'.$cate_pro->category_id}}" style="font-size: 20px" class="active" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Are you sure to delete this row?')" href="{{\Illuminate\Support\Facades\URL::to('/delete-category-product/').'/'.$cate_pro->category_id}}" style="font-size: 20px" class="active" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                import--}}
{{--                <form action="{{\Illuminate\Support\Facades\URL::to('import-csv')}}" method="POST" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <input type="file" name="file" accept=".xlsx"><br>--}}
{{--                    <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">--}}
{{--                </form>--}}
{{--                export--}}
{{--                <form action="{{\Illuminate\Support\Facades\URL::to('export-csv')}}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">--}}
{{--                </form>--}}

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
