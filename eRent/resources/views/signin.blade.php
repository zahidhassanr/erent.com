@extends('layouts.master')

@section('header')

<link rel="stylesheet" type="text/css" href="{{asset('css/signin.css')}}">
@endsection



@section('content')
    <div class="sing_in_container">
        <h4 >Log in</h4>
        <form class="sign_in_form" method="POST" action="{{route('signing-in')}}">
            {{ csrf_field() }}
            <div class="sign_in_email">
                <label for="email" class="col-md-4 email_label">Email-Address</label>

                <input type="email" class="col-md-8 email_text" name="email" />
            </div>

            <div class="sign_in_password">
                <label for="password" class="col-md-4 password_label">Password</label>

                <input type="password" class="col-md-8 password_text" name="password"/>
            </div>
            <div class="form_submit">
                <button type="submit" class="sub_button" >Submit</button>
                <a href="#" class="forgot_label ">Forgot password</a>
            </div>
        </form>

    </div>


@endsection