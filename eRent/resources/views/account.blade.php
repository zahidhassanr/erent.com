@extends('layouts.master')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">

@endsection


@section('content')

<?php

if(session()->get('user_type')=='both')
{
    $customer=\App\Customer::where('customer_id',session()->get('id'))->get();
    $owner=\App\Owner::where('owner_id',session()->get('id'))->get();

}


if(session()->get('user_type')=='customer')
    {
       $customer=\App\Customer::where('customer_id',session()->get('id'))->get();
    }

    if(session()->get('user_type')=='owner')
    {
       $owner=\App\Owner::where('owner_id',session()->get('id'))->get();


    }



?>

@if(session()->get('user_type')=='customer')

<div class="customer_sel">
        <h3>Property selected</h3>
    @foreach($customer as $property)
        <?php
            $items=\App\Properties::where('id',$property->properties_id)->first();

        ?>

        <div class="property-container">

            <div class="image-container">
                <a href="#"><img width="330px" height="300px" id="{{$items->id}}" src="{{asset($items->imageUrl)}}"/></a>
            </div>

            <div class="property-description">
                <h3>{{$items->name}}</h3>
                <div class="property-basic">
                    <div class="roww">
                        <i class="fa fa-bed"> {{$items->rooms}} bedrooms</i>
                        <i class="fa fa-buysellads"> {{$items->area}} sqft</i>
                        <i class="fa fa-bath">{{$items->toilet}} bathrooms</i>
                        @if($items->parking)
                            <i class="fa fa-car"> parking</i>
                        @else
                            <i class="fa fa-car"> no parking</i>
                        @endif
                    </div>
                </div>

                <div class="property-amount">
                    <div class="roww">

                        <a href="{{ route('property',['property_id' => $items->id]) }}" style="color:black"><button class="description-button" type="button" >Description</button></a>
                        <i class="fa fa-money"> {{$items->price}} Tk</i>
                    </div>


                </div>
            </div>

        </div>

    @endforeach

    </div>





@elseif(session()->get('user_type')=='owner')

    <div class="owner_sel">
        <h3>Property uploaded</h3>
        @foreach($owner as $property)

            <?php
            $items=\App\Properties::where('id',$property->properties_id)->first();

            ?>
            <div class="property-container">

                <div class="image-container">
                    <a href="#"><img width="330px" height="300px" id="{{$items->id}}" src="{{asset($items->imageUrl)}}"/></a>
                </div>

                <div class="property-description">
                    <h3>{{$items->name}}</h3>
                    <div class="property-basic">
                        <div class="roww">
                            <i class="fa fa-bed"> {{$items->rooms}} bedrooms</i>
                            <i class="fa fa-buysellads"> {{$items->area}} sqft</i>
                            <i class="fa fa-bath">{{$items->toilet}} bathrooms</i>
                            @if($items->parking)
                                <i class="fa fa-car"> parking</i>
                            @else
                                <i class="fa fa-car"> no parking</i>
                            @endif
                        </div>
                    </div>

                    <div class="property-amount">
                        <div class="roww">

                            <a href="{{ route('property',['property_id' => $items->id]) }}" style="color:black"><button class="description-button" type="button" >Description</button></a>
                            <i class="fa fa-money"> {{$items->price}} Tk</i>
                        </div>


                    </div>
                </div>

            </div>

        @endforeach

    </div>


@else

    <div class="owner_sel">
        <h3>Property uploaded</h3>
        @foreach($owner as $property)

            <?php
            $items=\App\Properties::where('id',$property->properties_id)->first();

            ?>
            <div class="property-container">

                <div class="image-container">
                    <a href="#"><img width="330px" height="300px" id="{{$items->id}}" src="{{asset($items->imageUrl)}}"/></a>
                </div>

                <div class="property-description">
                    <h3>{{$items->name}}</h3>
                    <div class="property-basic">
                        <div class="roww">
                            <i class="fa fa-bed"> {{$items->rooms}} bedrooms</i>
                            <i class="fa fa-buysellads"> {{$items->area}} sqft</i>
                            <i class="fa fa-bath">{{$items->toilet}} bathrooms</i>
                            @if($items->parking)
                                <i class="fa fa-car"> parking</i>
                            @else
                                <i class="fa fa-car"> no parking</i>
                            @endif
                        </div>
                    </div>

                    <div class="property-amount">
                        <div class="roww">

                            <a href="{{ route('property',['property_id' => $items->id]) }}" style="color:black"><button class="description-button" type="button" >Description</button></a>
                            <i class="fa fa-money"> {{$items->price}} Tk</i>
                        </div>


                    </div>
                </div>

            </div>

        @endforeach

    </div>





        <div class="customer_sel">
            <h3>Property selected</h3>
            @foreach($customer as $property)

                <?php
                $items=\App\Properties::where('id',$property->properties_id)->first();

                ?>
                <div class="property-container">

                    <div class="image-container">
                        <a href="#"><img width="330px" height="300px" id="{{$items->id}}" src="{{asset($items->imageUrl)}}"/></a>
                    </div>

                    <div class="property-description">
                        <h3>{{$items->name}}</h3>
                        <div class="property-basic">
                            <div class="roww">
                                <i class="fa fa-bed"> {{$items->rooms}} bedrooms</i>
                                <i class="fa fa-buysellads"> {{$items->area}} sqft</i>
                                <i class="fa fa-bath">{{$items->toilet}} bathrooms</i>
                                @if($items->parking)
                                    <i class="fa fa-car"> parking</i>
                                @else
                                    <i class="fa fa-car"> no parking</i>
                                @endif
                            </div>
                        </div>

                        <div class="property-amount">
                            <div class="roww">

                                <a href="{{ route('property',['property_id' => $items->id]) }}" style="color:black"><button class="description-button" type="button" >Description</button></a>
                                <i class="fa fa-money"> {{$items->price}} Tk</i>
                            </div>


                        </div>
                    </div>

                </div>

            @endforeach

        </div>



    @endif


@endsection