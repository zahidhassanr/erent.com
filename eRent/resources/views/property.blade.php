@extends('layouts.master')

@section('header')

    <link rel="stylesheet" type="text/css" href="{{asset('css/property.css')}}">
@endsection


@section('content')

    <?php

        $customer=\App\Customer::where('properties_id',$property_id->id)->first();
        if((count($customer)) && ($customer->customer_id == session()->get('id')))
        {


            session()->put('already_selected','true');

        }

    $owner=\App\Owner::where('properties_id',$property_id->id)->first();

    if((count($owner)) && ($owner->owner_id == session()->get('id')))
    {
        session()->put('already_selected_own','true');

    }


    Mapper::map(
        $property_id->x_coordinate,
        $property_id->y_coordinate,
        [
            'zoom' => 16,
            'draggable' => true,
            'marker' => true,
            'eventAfterLoad' =>
                'circleListener(maps[0].shapes[0].circle_0);'
        ]

    );
    ?>

    <h2 class="property-name">{{$property_id->name}}</h2>

    <div class="property-image">
        <img width="320x" height="350px" src="{{asset($property_id->imageUrl)}}"/>
    </div>

    <div class="property-table">
        <table style="border:1px solid black" width="300px" class="table-property">
            <tr>
                <td colspan="3" style="background: #EEEEEE">Bedrooms</td>
                <td colspan="3" style="background: #EEEEEE">{{$property_id->bedrooms}}</td>
            </tr>
            <tr>
                <td colspan="3">Drawing rooms</td>
                <td colspan="3">{{$property_id->drawingrooms}}</td>
            </tr>
            <tr>
                <td colspan="3" style="background: #EEEEEE">Dining rooms</td>
                <td colspan="3" style="background: #EEEEEE">{{$property_id->diningrooms}}</td>
            </tr>
            <tr>
                <td colspan="3">Bathroom</td>
                <td colspan="3">{{$property_id->toilet}}</td>
            </tr>
            @if($property_id->parking)

                <tr>
                    <td colspan="3" style="background: #EEEEEE">Parking</td>
                    <td colspan="3" style="background: #EEEEEE">Yes</td>
                </tr>

            @else
                <tr>
                    <td colspan="3" style="background: #EEEEEE">Parking</td>
                    <td colspan="3" style="background: #EEEEEE">No</td>
                </tr>


            @endif
            <tr>
                <td colspan="3">Size</td>
                <td colspan="3">{{$property_id->area}} sqft</td>
            </tr>
            <tr>
                <td colspan="3" style="background: #EEEEEE">Price</td>
                <td colspan="3" style="background: #EEEEEE">{{$property_id->price}} Tk/month</td>
            </tr>
            <tr>
                <td colspan="3">Service charge</td>
                <td colspan="3">{{$property_id->servicecharge}} Tk/month</td>
            </tr>

        </table>
    </div>
@if(session()->get('already_selected') !='true')
    @if(session()->get('already_selected_own') =='true')
    @else
    <div class="apply-button">
        <button class="button-apply" id="applybutton" href="#">Apply-appointment</button>
    </div>
        @endif
@endif
    @if(session()->get('name')==null)
        <?php
        session()->put('not-login', 'true');
        ?>
        <script>
            $(document).ready(function () {
                $("#applybutton").click(function () {
                    $("#myModal").modal();

                });
            });


        </script>



    @else
        <script>
            $(document).ready(function () {
                $("#applybutton").click(function () {
                    $("#appointment-form").modal();

                });
            });


        </script>


    @endif


    <div class="property-des">
        <h3>Description</h3>
        <div class="description-textarea">
            <p>{{$property_id->description}}</p>
        </div>
    </div>

    <div class="property-location" style="height: 400px; width: 1000px">

        <h3>Location</h3>

        {!! Mapper::render()!!}

    </div>


    <div class="modal fade" id="appointment-form" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><i class="fa fa-envelope"></i> Appointment</h4>
                </div>
                <div class="modal-body" style="padding:40px 50px;">

                    <form role="form" method="POST"
                          action="{{route('appointment',['property_id' => $property_id->id])}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="phone"><span class="glyphicon glyphicon-eye-open"></span> Phone Number</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter contact number"
                                   name="phone">
                        </div>

                        <div class="form-group">
                            <label for="date"><i class="fa fa-calendar"></i> Date</label>
                            <input type="date" class="form-control" value="2011-01-13" name="date">

                        </div>

                        <div class="form-group">
                            <label for="time"><i class="fa fa-clock-o"></i> Time</label>
                            <input type="time" class="form-control" name="time">

                        </div>

                        <button type="submit" class="btn btn-success btn-block"><span
                                    class="glyphicon glyphicon-off"></span> Submit
                        </button>


                    </form>
                </div>
            </div>
        </div>

    </div>



    <?php
    session()->put('already_selected','false');
    session()->put('already_selected_own','false');
    ?>

@endsection