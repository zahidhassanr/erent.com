@extends('layouts.master')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/home.css')}}">

@endsection

@section('content')


<?php
$property1=null;

        if(!$property->count()){
            $search=0;
            $prefered=\App\Properties::where([
                ['district','=',$district],
                ['location', '=',$location],
                ['property_type','=',$property_type],
                ['sale_type','=',$type]

            ])->get();

            if($prefered->count())
            {

                $property=$prefered;
               // $property1=$prefered;

            }
            else{
                $prefered1=\App\Properties::where([

                    ['district','=',$district],
                    ['property_type','=',$property_type],
                    ['sale_type','=',$type]
                ])->get();

                if($prefered1->count())
                {

                    $property=$prefered1;
                   // $property1=$prefered1;
                }
            }

        }
        else{
            $search=1;

            $prefered=\App\Properties::where([
                ['district','=',$district],
                ['location', '=',$location],
                ['property_type','=',$property_type],
                ['sale_type','=',$type],
                ['price','<',$min_price],
                ['price','>',$max_price]
            ])->get();

            if($prefered->count())
            {

                $property1=$prefered;
                // $property1=$prefered;

            }
            else{
                $prefered1=\App\Properties::where([

                    ['district','=',$district],
                    ['location', '<>',$location],
                    ['property_type','=',$property_type],
                    ['sale_type','=',$type]
                ])->get();

                if($prefered1->count())
                {

                    $property1=$prefered1;
                    // $property1=$prefered1;
                }
            }

        }

 ?>


    @if($search == 0)
        <div class="no-result">
            <h3 style="color:red;">No search result, Please try again</h3>
            <hr>

            <h3>People also search for</h3>
            @foreach($property as $items)


                <div class="property-container">

                    <div class="image-container">
                        <a href="#"><img width="330px" height="300px" id="{{$items->id}}" src="{{asset($items->imageUrl)}}"/></a>
                    </div>

                    <div class="property-description">
                        <h3>{{$items->name}}</h3>
                        <div class="property-basic">
                            <div class="roww">
                                <i class="fa fa-bed"> {{$items->rooms}} bedrooms</i>
                                @if($items->property_type=="plot")
                                <i class="fa fa-buysellads"> {{$items->area}} Katha</i>
                                @else
                                    <i class="fa fa-buysellads"> {{$items->area}} sqft</i>
                                @endif
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

<div class="search-result">

    <h3>search result</h3>
    @foreach($property as $items)


        <div class="property-container">

            <div class="image-container">
                <a href="#"><img width="330px" height="300px" id="{{$items->id}}" src="{{asset($items->imageUrl)}}"/></a>
            </div>

            <div class="property-description">
                <h3>{{$items->name}}</h3>
                <div class="property-basic">
                    <div class="roww">
                        <i class="fa fa-bed"> {{$items->rooms}} bedrooms</i>
                        @if($items->property_type=="plot")
                            <i class="fa fa-buysellads"> {{$items->area}} Katha</i>
                        @else
                            <i class="fa fa-buysellads"> {{$items->area}} sqft</i>
                        @endif
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

@if(count($property1))
    <h3>People also search for</h3>
    @foreach($property1 as $items)


        <div class="property-container">

            <div class="image-container">
                <a href="#"><img width="330px" height="300px" id="{{$items->id}}" src="{{asset($items->imageUrl)}}"/></a>
            </div>

            <div class="property-description">
                <h3>{{$items->name}}</h3>
                <div class="property-basic">
                    <div class="roww">
                        <i class="fa fa-bed"> {{$items->rooms}} bedrooms</i>
                        @if($items->property_type=="plot")
                            <i class="fa fa-buysellads"> {{$items->area}} Katha</i>
                        @else
                            <i class="fa fa-buysellads"> {{$items->area}} sqft</i>
                        @endif
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
    @endif
</div>


    @endif

@endsection
