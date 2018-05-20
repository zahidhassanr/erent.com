@extends('layouts.master')

@section('header')
<link rel="stylesheet" type="text/css" href="{{asset('css/post-property.css')}}">
@endsection

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="property-post">
        <form action="{{route('post')}}" method="POST">
            {{ csrf_field() }}
            <div class="user-email">
                <label for="email"  style="font-size: 16px">Username</label>
                <input type="text" name="email" placeholder="Email address" style="margin-left:50px; margin-bottom: 20px;">

            </div>

            <div class="user-password">
                <label for="password" style="font-size: 16px">Password</label>
                <input type="password" name="password" style="margin-left:50px ; margin-bottom: 20px;">

            </div>
            <div class="user-email">
                <label for="email"  style="font-size: 16px">Property Name</label>
                <input type="text" name="property_name" placeholder="Name" style="margin-left:10px; margin-bottom: 20px;">

            </div>

        <div class="property-type">

            <div class="type-label">
                <label for="type-select" style="font-size: 16px">Property Type</label>
            </div>
<div class=" select-type">
            <select class="type-select" id="type_select" name="type_select" onchange="myfunction()">

                <option value="plot" >plot</option>
                <option value="flat">flat</option>
                <option value="commercial">commercial area</option>

            </select>

</div>

        </div>

            <div class="radio-type">
                <div class="label-radio">

                    <label style="font-size: 16px">Type</label>
                </div>

                <div class="radio-class">
                <label>
                    <input type="radio" name="type_radio" value="sell" checked>
                    Sell
                </label>

                <label class="rent-radio">
                    <input type="radio" name="type_radio" value="rent">
                    Rent
                </label>
                </div>

            </div>
            <div class="modal fade" id="flat" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
            <div class="bed-desc">

                <lable style="font-size: 16px">Bedrooms</lable>
                <input type="number" name="bedroom_num" value="0">
            </div>

                <div class="draw-desc">

                <lable style="font-size: 16px">Drawing rooms</lable>
                <input type="number" name="drawroom_num" value="0">
            </div>

                <div class="din-desc">

                <lable style="font-size: 16px">Dining rooms</lable>
                <input type="number" name="dinroom_num" value="0">
            </div>

                    <div class="din-desc">

                        <lable style="font-size: 16px">Wash Rooms</lable>
                        <input type="number" name="toilet" value="0">
                    </div>

                <div class="radio-apart">
                    <div class="label-radio-apart">

                        <label style="font-size: 16px">Parking</label>
                    </div>

                    <div class="radio-class-apart">
                        <label style="font-size: 16px">
                            <input type="radio" name="apart_parking" value="yes" >
                            Yes
                        </label>

                        <label class="apart-radio" style="font-size: 16px">
                            <input type="radio" name="apart_parking" value="no">
                            No
                        </label>
                    </div>

                </div>

                    <div class="area-flat">
                        <label style="font-size: 16px">Area</label>
                        <input type="number" name="area_flat" value="0"> Sqft
                    </div>

                    <div class="price-flat">
                        <label style="font-size: 16px">Price</label>
                        <input type="number" name="price_flat" value="0"> Tk
                    </div>

                    <div class="service-flat">
                        <label style="font-size: 16px">Service charge</label>
                        <input type="number" name="service_flat" value="0"> Tk
                    </div>


</div>
            </div>


    </div>


            <div class="modal fade" id="plot" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="area-plot">

                            <label style="font-size: 16px">Area</label>
                            <input type="number" name="area_plot" value="0"> Katha
                        </div>

                        <div class="price-plot">

                            <label style="font-size: 16px">Price</label>
                            <input type="number" name="price_plot" value="0"> Tk
                        </div>



                    </div>
                </div>


            </div>


            <div class="modal fade" id="commercial" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="area-flat">
                        <label style="font-size: 16px">Area</label>
                        <input type="number" name="area_comm" value="0"> Sqft
                    </div>

                    <div class="price-flat">
                        <label style="font-size: 16px">Price</label>
                        <input type="number" name="price_comm" value="0">Tk
                    </div>

                    <div class="service-flat">
                        <label style="font-size: 16px">Service charge</label>
                        <input type="number" name="service_comm" value="0"> Tk
                    </div>

                        <div class="radio-class-comm">

                            <div class="label-radio-comm">

                                <label style="font-size: 16px">Parking</label>
                            </div>
                            <label>
                                <input type="radio" name="comm_parking" value="yes" >
                                Yes
                            </label>

                            <label class="comm-radio">
                                <input type="radio" name="comm_parking" value="no">
                                No
                            </label>
                        </div>





                    </div>
                </div>


            </div>



            <div class="city">
                <label class="city-label" style=" font-size: 16px">District</label>

                <input type="text" name="city_name" placeholder="Enter city" style="margin-left:70px; margin-bottom: 20px;">

            </div>

            <div class="location">
                <label class="location-label" style=" font-size: 16px">location</label>

                <input type="text" name="location_name" placeholder="Enter loation" style="margin-left:65px; margin-bottom: 20px;">

            </div>

                    <div class="description">
                        <label class="description-label" style=" font-size: 16px">Description</label>
<br>
                        <textarea name="description_name"  rows="3"   placeholder="Enter description" style="margin-bottom: 20px;width: 320px"></textarea>

                    </div>


            <div class="file">

                <label for="file" style="font-size: 16px">Choose File</label>
                <input type="file" name="file" value="">
            </div>

            <div class="submit_but">
                <button type="submit">Post</button>
            </div>


        </form>

    </div>
    <script>
        function myfunction()
        {
            var x=document.getElementById("type_select");
            var i=x.selectedIndex;


            if(i == "0") {
                $("#plot").modal();
            }

            if(i == "1")
            {


                    $("#flat").modal();


            }if(i == "2")
            {
                $(document).ready(function () {

                    $("#commercial").modal();

                });
            }
        }
    </script>

@endsection