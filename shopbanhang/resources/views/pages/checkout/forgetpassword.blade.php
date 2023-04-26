@extends('welcome')
@section('content')
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Điền email để lấy lại mật khẩu</h2>
                        <form action="{{\Illuminate\Support\Facades\URL::to('/recover-pass')}}" method="post">
                            {{csrf_field()}}
                            <input type="text" name="email_account" placeholder="Email...." />
                            <button type="submit" class="btn btn-default">Gửi email</button>
                        </form>
                    </div><!--/login form-->
                </div>

            </div>
        </div>
    </section><!--/form-->

@endsection
