<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
    <title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>
</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="index.html" class="logo">
                VISITORS
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- settings start -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-tasks"></i>
                        <span class="badge bg-success">8</span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <li>
                            <p class="">You have 8 pending tasks</p>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Target Sell</h5>
                                        <p>25% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="45">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Product Delivery</h5>
                                        <p>45% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="78">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Payment collection</h5>
                                        <p>87% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="60">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="task-info clearfix">
                                    <div class="desc pull-left">
                                        <h5>Target Sell</h5>
                                        <p>33% , Deadline  12 June’13</p>
                                    </div>
                                    <span class="notification-pie-chart pull-right" data-percent="90">
                            <span class="percent"></span>
                            </span>
                                </div>
                            </a>
                        </li>

                        <li class="external">
                            <a href="#">See All Tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- settings end -->
                <!-- inbox dropdown start-->
                <li id="header_inbox_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-important">4</span>
                    </a>
                    <ul class="dropdown-menu extended inbox">
                        <li>
                            <p class="red">You have 4 Mails</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="public/backend/images/3.png"></span>
                                <span class="subject">
                                <span class="from">Jonathan Smith</span>
                                <span class="time">Just now</span>
                                </span>
                                <span class="message">
                                    Hello, this is an example msg.
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="public/backend/images/1.png"></span>
                                <span class="subject">
                                <span class="from">Jane Doe</span>
                                <span class="time">2 min ago</span>
                                </span>
                                <span class="message">
                                    Nice admin template
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="public/backend/images/3.png"></span>
                                <span class="subject">
                                <span class="from">Tasi sam</span>
                                <span class="time">2 days ago</span>
                                </span>
                                <span class="message">
                                    This is an example msg.
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="public/backend/images/2.png"></span>
                                <span class="subject">
                                <span class="from">Mr. Perfect</span>
                                <span class="time">2 hour ago</span>
                                </span>
                                <span class="message">
                                    Hi there, its a test
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">See all messages</a>
                        </li>
                    </ul>
                </li>
                <!-- inbox dropdown end -->
                <!-- notification dropdown start-->
                <li id="header_notification_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-warning">3</span>
                    </a>
                    <ul class="dropdown-menu extended notification">
                        <li>
                            <p>Notifications</p>
                        </li>
                        <li>
                            <div class="alert alert-info clearfix">
                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                <div class="noti-info">
                                    <a href="#"> Server #1 overloaded.</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="alert alert-danger clearfix">
                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                <div class="noti-info">
                                    <a href="#"> Server #2 overloaded.</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="alert alert-success clearfix">
                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                <div class="noti-info">
                                    <a href="#"> Server #3 overloaded.</a>
                                </div>
                            </div>
                        </li>

                    </ul>
                </li>
                <!-- notification dropdown end -->
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text"  name="keywords_submit" class="form-control search" placeholder=" Tìm kiếm">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="public/backend/images/2.png">
                        <span class="username">
                         <?php
                         $message=\Illuminate\Support\Facades\Session::get('admin_name');
                         if($message)
                         {
                             echo $message;
                         }
                         ?>
                        </span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="{{\Illuminate\Support\Facades\URL::to('/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->

            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="{{\Illuminate\Support\Facades\URL::to('/dashboard')}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Tổng quan</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Banner</span>
                        </a>
                        <ul class="sub">

                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/manage-slider')}}">Quản lý Slide</a></li>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/add-slider')}}">Thêm Slide</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Đơn hàng</span>
                        </a>
                        <ul class="sub">

                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Mã giảm giá</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/list-coupon')}}">Quản lý mã giảm giá</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Vận chuyển</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Danh mục sản phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/add-category-product')}}">Thêm danh mục</a></li>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/all-category-product')}}">Liệt kê danh mục</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Thương hiệu sản phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Sản phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/add-product')}}">Thêm  sản phẩm</a></li>
                            <li><a href="{{\Illuminate\Support\Facades\URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                        </ul>
                    </li>
                </ul>            </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- //market-->
            <!-- //market-->
            <!-- tasks -->
            <!-- //tasks -->
@yield('admin_content')
        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
            </div>
        </div>
        <!-- / footer -->
    </section>
    <!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('public/backend/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->

<!-- calendar -->
<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
<script type="text/javascript">
    $(window).load( function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch(window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
        $(document).ready(function () {
            function fectch_delivery(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{\Illuminate\Support\Facades\URL::to('/select-feeship')}}',
                    method:'POST',
                    data:{_token:_token},
                    success:function (data) {
                        $('#load_delivery').html(data);
                    }
                })
            }
            $('.order_orderdetails').change(function () {
                var order_status = $(this).val();
                var order_id= $(this).children(":selected").attr("id");
                var _token =$('input[name="_token"]').val();
                var order_code = $('.order_product_code').val();
                //lay ra so luong
                quantity=[];
                $("input[name='product_sales_quantity']").each(function () {
                    quantity.push($(this).val());
                })
                order_detail_product_id=[];
                $("input[name='order_detail_product_id']").each(function () {
                    order_detail_product_id.push($(this).val());
                })
                //lay ra product id
                order_product_id=[];
                $("input[name='order_product_id']").each(function () {
                    order_product_id.push($(this).val());
                })
                j=0;k=0;
                for (i=0;i<order_product_id.length;i++)
                {
                    var order_qty = $('.order_qty_'+order_product_id[i]).val();
                    var order_qty_storage =$('.order_qty_storage_'+order_product_id[i]).val();
                    var order_qty_sold =$('.order_qty_sold_'+order_product_id[i]).val();
                    if(parseInt(order_qty)>parseInt(order_qty_storage))
                    {
                        j++;
                        alert('Số lượng bán trong kho không đủ')
                        $('.color_qty_'+order_product_id[i]).css('background','#ADD8E6')
                    }
                    if(order_status!=2)
                    {
                        if(parseInt(order_qty_sold)<parseInt(order_qty))
                        {
                            if(j==0)
                            {
                                k++;
                                alert('Số lượng trả về không đủ')
                                $('.color_qty_'+order_product_id[i]).css('background','#ADD8E6')
                            }
                        }
                    }

                }
                if(j==0)
                {
                    if(k==0)
                    {
                        $.ajax({
                            url:'{{\Illuminate\Support\Facades\URL::to('/update-order-qty')}}',
                            method:'POST',
                            data:{order_status:order_status,order_id:order_id,order_detail_product_id:order_detail_product_id,quantity:quantity,order_product_id:order_product_id,_token:_token},
                            success:function (data) {
                                alert('Cập nhật số lượng thành công');
                                location.reload();
                            }
                        })
                    }


                }

            })
            $(document).on('blur','.fee_feeship_edit',function () {
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{\Illuminate\Support\Facades\URL::to('/update-delivery')}}',
                    method:'POST',
                    data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                    success:function (data) {
                        fectch_delivery();
                    }
                })
            })
            $('.update_quantity_order').click(function () {
                var order_product_id = $(this).data('product_id');
                var order_qty = $('.order_qty_'+order_product_id).val();
                var order_code = $('.order_product_code').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{\Illuminate\Support\Facades\URL::to('/update-qty')}}',
                    method:'POST',
                    data:{order_product_id:order_product_id,order_qty:order_qty,order_code:order_code,_token:_token},
                    success:function (data) {
                        alert('Cập nhật số lượng thành công');
                        location.reload();
                    }
                })
            })
        $('.add_delivery').click(function () {
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var feeship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{\Illuminate\Support\Facades\URL::to('/insert-delivery')}}',
                method:'POST',
                data:{city:city,province:province,wards:wards,feeship:feeship,_token:_token},
                success:function (data) {
fectch_delivery();
                }
            })
        })
            $('.choose').on('change',function () {
                var action = $(this).attr('id');
                var matp = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if(action=='city'){
                    result = 'province';
                }
                else{
                    result = 'wards';
                }
                $.ajax({
                    url:'{{\Illuminate\Support\Facades\URL::to('/select-delivery')}}',
                    method:'POST',
                    data:{action:action,matp:matp,_token:_token},
                    success:function (data) {
                        $('#'+result).html(data);

                    }
                })
            })
            fectch_delivery();

    })
</script>
<!-- //calendar -->
</body>
</html>
