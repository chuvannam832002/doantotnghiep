@extends('admin_layout')
@section('admin_content')
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thư viện ảnh
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
            <form action="{{url('/insert-gallery').'/'.$pro_id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3" align="right">

                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                        <span id="error_gallery"></span>
                    </div>
                    <div class="col-md-3">
                        <input type="submit" name="upload" value="Tải ảnh " class="btn btn-success">
                    </div>
                </div>
            </form>
<form>
            <div class="panel-body">
                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                    @csrf
                <div id="gallery_load">

                </div>
            </div>
            </form>

        </section>

    </div>
@endsection
