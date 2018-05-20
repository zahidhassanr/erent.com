@extends('layouts.master')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('css/find-property.css')}}">
@endsection

@section('content')
    <div class="find-property" style="background-image: url({{url('images/background.jpg')}})">


        <div class="search-container">
            <form method="POST" action="{{route('search')}}">
                {{ csrf_field() }}
                <div class="radio-buttons">
                    <input type="radio" id="buyflat" name="property_type" value="buyflat" checked>
                    <label for="buyflat">Buy Flat</label>

                    <input type="radio" id="rentflat" name="property_type" value="rentflat">
                    <label for="rentflat">Rent Flat</label>

                    <input type="radio" id="buyplot" name="property_type" value="buyplot">
                    <label for="buyplot">Buy Plot</label>

                    <input type="radio" id="com-area" name="property_type" value="com-area">
                    <label for="com-area">Commercial Area</label>
                </div>

                <div class="search-item">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="district">District</label>
                            <input type="text" name="district" id="district">
                        </div>

                        <div class="col-md-6">
                            <label for="minprice">Min Price</label>
                            <input type="number" name="minprice" id="minprice" value="0">
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label for="area">Area &nbsp;&nbsp;&nbsp; </label>
                            <input type="text" name="area" id="area">
                        </div>
                        <div class="col-md-6">
                            <label for="maxprice">Max Price</label>
                            <input type="number" name="maxprice" id="maxprice" value="0">
                        </div>
                    </div>

                    <div class="submit-button-search">
                        <button type="submit" class="search-button">Search</button>
                    </div>

                </div>




            </form>

        </div>


    </div>


@endsection