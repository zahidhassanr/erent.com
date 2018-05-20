@extends('layouts.master')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/appointment.css')}}">

@endsection

<?php

        $appointment_customer=20;
        $appointment_owner=20;

        $meeting1=\App\Meeting::where('customer_id',session()->get('id'))->get();
        //$employee1=\App\Employee::where('employee_id',$meeting1->employee_id)->first();
        $meeting2=\App\Meeting::where('owner_id',session()->get('id'))->get();
        //$employee2=\App\Employee::where('employee_id',$meeting2->employee_id)->first();

        if(session()->get('user_type')=="both")
        {
  //          $meeting1=\App\Meeting::where('customer_id',session()->get('id'))->get();
//            $meeting2=\App\Meeting::where('owner_id',session()->get('id'))->get();
            if(!count($meeting1))
            {
                $appointment_customer=0;
            }
            if(!count($meeting2))
            {
                $appointment_owner=0;
            }

        }

        if(session()->get('user_type')=="owner")
        {
    //        $meeting=\App\Meeting::where('owner_id',session()->get('id'))->get();
            if(!count($meeting2))
            {
                $appointment_owner=0;
            }

        }

        if(session()->get('user_type')=="customer")
        {
           // $meeting=\App\Meeting::where('customer_id',session()->get('id'))->get();
            if(!count($meeting1))
            {
                $appointment_customer=0;
            }

        }


?>

@section('content')

    @if(($appointment_owner==0 && (session()->get('user_type')=="owner")) || ($appointment_customer==0 && (session()->get('user_type')=="customer")) || (($appointment_owner==0 && $appointment_customer==0) && (session()->get('user_type')=="both")))
    <div class="no-appointment">
        <h3>You have no appointment</h3>
    </div>

    @elseif($appointment_owner!=0 && (session()->get('user_type')=="owner"))
        <div class="appointment">
            <h3>Meeting as owner</h3>
        </div>
    <div class="owner_table">
        <table style="border: 1px solid black;">
            <tr><th>Customer name</th><th>Customer phone</th><th>Employee name</th><th>Employee phone</th><th>Meeting Date</th><th>Meeting time</th></tr>
            @foreach($meeting2 as $meet)
                <?php
                    $cus=\App\User::where('id',$meet->customer_id)->first();
                    $emp=\App\Employee::where('employee_id',$meet->employee_id)->first();
                    ?>
                <tr><td>{{$cus->name}}</td><td>{{$meet->customer_phone}}</td><td>{{$emp->employee_name}}</td><td>{{$emp->employee_phone}}</td><td>{{$meet->meeting_date}}</td><td>{{$meet->meeting_time}}</td></tr>

            @endforeach

        </table>
    </div>


    @elseif($appointment_customer!=0 && (session()->get('user_type')=="customer"))
        <div class="appointment">
            <h3>Meeting as Customer</h3>
        </div>
    <div class="owner_table">
        <table style="border: 1px solid black;">
            <tr><th>Owner name</th><th>Owner phone</th><th>Employee name</th><th>Employee phone</th><th>Meeting Date</th><th>Meeting time</th></tr>

            @foreach($meeting1 as $meet)
                <?php
                $own=\App\User::where('id',$meet->owner_id)->first();
                $emp=\App\Employee::where('employee_id',$meet->employee_id)->first();
                ?>
                <tr><td>{{$own->name}}</td><td>{{$meet->owner_phone}}</td><td>{{$emp->employee_name}}</td><td>{{$emp->employee_phone}}</td><td>{{$meet->meeting_date}}</td><td>{{$meet->meeting_time}}</td></tr>

            @endforeach


        </table>
    </div>


    @elseif(($appointment_owner!=0 || $appointment_customer!=0)  && (session()->get('user_type')=="both"))

            @if($appointment_owner !=0)
                <div class="appointment">
                    <h3>Meeting as owner</h3>
                </div>
            <div class="owner_table">
                <table style="border: 1px solid black;">
                    <tr><th>Customer name</th><th>Customer phone</th><th>Employee name</th><th>Employee phone</th><th>Meeting Date</th><th>Meeting time</th></tr>
                    @foreach($meeting2 as $meet)
                        <?php
                        $cus=\App\User::where('id',$meet->customer_id)->first();
                        $emp=\App\Employee::where('employee_id',$meet->employee_id)->first();
                        ?>
                        <tr><td>{{$cus->name}}</td><td>{{$meet->customer_phone}}</td><td>{{$emp->employee_name}}</td><td>{{$emp->employee_phone}}</td><td>{{$meet->meeting_date}}</td><td>{{$meet->meeting_time}}</td></tr>

                    @endforeach

                </table>
            </div>
            @endif
            @if($appointment_customer !=0)
                <div class="appointment">
                    <h3>Meeting as customer</h3>
                </div>
                <div class="owner_table">
                    <table style="border: 1px solid black;">
                        <tr><th>Owner name</th><th>Owner phone</th><th>Employee name</th><th>Employee phone</th><th>Meeting Date</th><th>Meeting time</th></tr>

                        @foreach($meeting1 as $meet)
                            <?php
                            $own=\App\User::where('id',$meet->owner_id)->first();
                            $emp=\App\Employee::where('employee_id',$meet->employee_id)->first();
                            ?>
                            <tr><td>{{$own->name}}</td><td>{{$meet->owner_phone}}</td><td>{{$emp->employee_name}}</td><td>{{$emp->employee_phone}}</td><td>{{$meet->meeting_date}}</td><td>{{$meet->meeting_time}}</td></tr>

                        @endforeach


                    </table>
                </div>

            @endif


    @endif


@endsection