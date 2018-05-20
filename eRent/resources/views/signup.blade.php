@extends('layouts.master')

@section('header')

<link rel="stylesheet" type="text/css" href="{{asset('css/signup.css')}}">
@endsection



@section('content')
    <div class="sign_up_container">

        <h4 >Sign up</h4>
        <form class="sign_up_form" method="POST" action="{{route('signing-up')}}">
            {{ csrf_field() }}

            <div class="sign_up_name">
                <label for="name" class="name_label">Full Name</label>

                <input type="text" class="name_text" name="name" required autofocus/>
            </div>

            <div class="sign_up_email">
                <label for="email" class="email_label">Email-Address</label>

                <input type="email" class="email_text" name="email" required autofocus/>
            </div>

            <div class="sign_up_password">
                <label for="password" class="password_label">Password</label>

                <input type="password" class="password_text" name="password" required autofocus/>
            </div>

            <div class="sign_up_password">
                <label for="con_password" class="password_label">Confirm Password</label>

                <input type="password" class="password_con" name="con_password" required autofocus/>
            </div>

            <div class="sign_up_mobile">
                <label for="mobile" class="mobile_label">Mobile No.</label>

                <input type="text" class="mobile_text" name="mobile" required autofocus/>
            </div>
            <div class="sign_up_Address">
                <label for="address" class="address_label">Address</label>

                <textarea row="5" class="address_text" name="address" required autofocus ></textarea>
            </div>



            <div class="sign_up_submit">
                <button type="submit" class="sign_up_button" >Sign Up</button>

            </div>


        </form>
    </div>


@endsection