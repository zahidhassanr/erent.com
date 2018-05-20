@extends('layouts.master')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">
@endsection

@section('content')
    <?php


    $property = \App\Properties::where('id',rand(1,8))->first();
    $property1 = \App\Properties::where('id', rand(1,8))->first();

    ?>


    <h3 class="property-heading">Best property for you</h3>

    <div class="property-container">

        <div class="image-container">
            <a href="#"><img width="330px" height="300px" id="{{$property->id}}" src="{{asset($property->imageUrl)}}"/></a>
        </div>

        <div class="property-description">
            <h3>{{$property->name}}</h3>
            <div class="property-basic">
                <div class="roww">
                    <i class="fa fa-bed"> {{$property->rooms}} bedrooms</i>
                    @if($property1->property_type=="plot")
                        <i class="fa fa-buysellads"> {{$property1->area}} Katha</i>
                    @else
                        <i class="fa fa-buysellads"> {{$property1->area}} sqft</i>
                    @endif
                    <i class="fa fa-bath">{{$property->toilet}} bathrooms</i>
                    @if($property->parking)
                        <i class="fa fa-car"> parking</i>
                    @else
                        <i class="fa fa-car"> no parking</i>
                    @endif
                </div>
            </div>

            <div class="property-amount">
                <div class="roww">

                    <a href="{{ route('property',['property_id' => $property->id]) }}" style="color:black"><button class="description-button" type="button" >Description</button></a>
                    <i class="fa fa-money"> {{$property->price}} Tk</i>
                </div>


            </div>
        </div>

    </div>

    <div class="property-container">

        <div class="image-container">
            <a href="#"><img width="330px" height="300px" id="{{$property1->id}}" src="{{asset($property1->imageUrl)}}"/></a>
        </div>

        <div class="property-description">
            <h3>{{$property1->name}}</h3>
            <div class="property-basic">
                <div class="roww">
                    <i class="fa fa-bed"> {{$property1->bedrooms}} bedrooms</i>
                    @if($property1->property_type=="plot")
                        <i class="fa fa-buysellads"> {{$property1->area}} Katha</i>
                    @else
                        <i class="fa fa-buysellads"> {{$property1->area}} sqft</i>
                    @endif
                    <i class="fa fa-bath">{{$property1->toilet}} bathrooms</i>
                    @if($property1->parking)
                        <i class="fa fa-car"> parking</i>
                    @else
                        <i class="fa fa-car"> no parking</i>
                    @endif
                </div>
            </div>

            <div class="property-amount">
                <div class="roww">

                    <a href="{{ route('property',['property_id' =>$property1->id]) }}" style="color:black"><button class="description-button" type="button">Description</button></a>
                    <i class="fa fa-money"> {{$property1->price}} Tk</i>
                </div>


            </div>
        </div>

    </div>

@endsection