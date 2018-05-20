<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/w3.css')}}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @yield('header')
    <title>eRent</title>
</head>



<body>
<div class="top">
    <div class="top_top_frame">
        <div class="containerr">
            <div class="roww">
                <div class="top_top_frame_left">
                    <ul class="phone_time_topmanu">
                        <li class="phone_image"><i class="fa fa-phone"></i></li>
                        <li class="phone">01878077310</li>
                        <li class="time">9:00 am - 12:00 pm, 7 days a week</li>
                    </ul>
                </div>

                <div class="top_top_frame_right">
                    <ul class="top-top-right">
                        <li class="contact_us"><a href="###">Contact Us</a></li>
                        <li class="support"><a href="###">Support</a></li>
                        <li class="about_us"><a href="###">About us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="top-middle-frame">
        <div class="logo">

            <div class="w3-jumbo"><a  style="text-decoration: none; color:black;"  href="{{route('welcome')}}"><i class="fa fa-home"></i>
                    <h2 class="logo-name">eRent</h2></a></div>


            <div class="post-find">
                <a class="fnd-property" href="{{route('find_property')}}">Find property</a>
                <a class="pst-property" href="{{route('post_property')}}">Post property</a>

                <div class="service_drop">
                    <button class="service">Service <i class="fa fa-caret-down"></i></button>

                    <div class="service_content">
                        <a href="#">Developers</a>
                        <a href="#">RAJUK justification</a>
                        <a href="#">Best Engineers</a>
                        <a href="#">Shipment</a>


                    </div>
                </div>

            </div>

            @if(session()->get('name')==null)
                <div class="sign-container">
                    <div class="roww">
                        <div class="sign_up">

                            <a href="{{route('sign-up')}}" style="color: black;">
                                <button type="button" id="sign_up_button">Sign Up</button>
                            </a>

                        </div>


                        <div class="sign_in">


                            <button type="button" id="sign_in_button" data-toggle="modal" data-target="#myModal">Sign
                                in
                            </button>


                        </div>
                    </div>
                </div>
            @else
                <div class="user-container">

                    <div class="user" id="user">
                        <i class="fa fa-user" style="font-size: 45px"></i><br> {{session()->get('name')}}

                    </div>



                    <div class="appointment">
                        @if(session()->get('user_type')=='both')
                            <a href="{{route('subscribed')}}" style="color: black;"><i class="fa fa-envelope" style="font-size: 45px"></i><br>
                                Appointment({{session()->get('property_num')}}) </a>
                        @elseif(session()->get('user_type')=='owner')
                            <a href="{{route('subscribed')}}" style="color: black;"><i class="fa fa-envelope" style="font-size: 45px"></i><br>
                                Appointment({{session()->get('property_num')}}) </a>
                        @elseif(session()->get('user_type')=='customer')
                            <a href="{{route('subscribed')}}" style="color: black;"><i class="fa fa-envelope" style="font-size: 45px"></i><br>
                                Appointment({{session()->get('property_num')}}) </a>
                        @else
                            <a href="{{route('subscribed')}}" style="color: black;"><i class="fa fa-envelope" style="font-size: 45px"></i><br>
                                Appointment(0) </a>
                        @endif
                    </div>
                    <div class="account_user" id="account">
                        <a href="{{route('account')}}"><button>Posts</button></a>
                    </div>
                    <div class="logout_user" id="logout">
                        <a href="{{route('logout')}}"><button>Logout</button></a>
                    </div>



                </div>


            @endif

        </div>

    </div>

</div>

@if(session()->get('login-error')=='true')
    <script>
        $(document).ready(function () {

            $("#myModal").modal();

        });
    </script>

@endif

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                @if(session()->get('login-error')=='true')
                    <p align="center" style="color: red">Wrong email or password</p>
                @endif

                <form role="form" method="POST" action="{{route('signing-in')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password"
                               name="password">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked>Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block"><span
                                class="glyphicon glyphicon-off"></span> Login
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel
                </button>
                <div class="forgot-pass">
                    <p>Not a member? <a href="{{route('sign-up')}}">Sign Up</a></p>
                    <p>Forgot <a href="#">Password?</a></p>
                </div>
            </div>
        </div>

    </div>
</div>


<?php
session()->put('login-error', 'false');
?>

@yield('content')


<div class="footer" style="margin-top:50px; background: #9CD2BA">
<hr style="border: none; border-bottom: 1px solid black;">
    <div class="wrapper">
        <div class="section group">
            <div class="row">
                <div class="col-md-3 information" style="border-left: 1px solid black;height: 200px;">
                    <h4>Information</h4>
                    <ul class="information" style="list-style: none;">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Customer Service</a></li>
                        <li><a href="#"><span>Advanced Search</span></a></li>
                        <li><a href="#">Orders and Returns</a></li>
                        <li><a href="#"><span>Contact Us</span></a></li>
                    </ul>
                </div>

                <div class="col-md-3 account" style="border-left: 1px solid black;height: 200px">
                    <h4>My account</h4>
                    <ul class="account" style="list-style: none;">
                        <li><a href="#">Sign In</a></li>
                        <li><a href="#">View Appointment</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
                <div class="col-md-3 contact" style="border-left: 1px solid black;height:200px;">
                    <h4>Contact</h4>
                    <ul class="contact" style="list-style: none;">
                        <li><span>+88-01713458599</span></li>
                        <li><span>+88-01813458552</span></li>
                    </ul>
                </div>
                <div class="col-md-3 follow" style="border-left: 1px solid black;height: 200px;">
                    <h4>Follow Us</h4>
                    <ul class="follow" style="list-style: none;">
                        <li class="facebook"><i class="fa fa-facebook" style="font-size:36px"></i> </li>
                        <li class="twitter"><i class="fa fa-twitter" style="font-size:36px"></i> </li>
                        <li class="googleplus"><i class="fa fa-google" style="font-size:36px"></i></li>
                        <li class="pinterest"><i class="fa fa-pinterest" style="font-size:36px"></i> </li>

                    </ul>
                </div>


            </div>

        </div>
    </div>


</div>

<script>
    $(document).ready(function(){
        $("#user").click(function(){
            $("#logout").toggle();
            $("#account").toggle();

        })

    });
</script>


</body>
</html>