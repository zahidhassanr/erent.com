<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {

    session()->put('user_type','user');
    return view('welcome');
})->name('home');


Route::get('/', function () {


    return view('welcome');
})->name('welcome');


Route::get('signup', [
    'uses' => 'Controller@signup',
    'as' => 'sign-up'

]);

Route::get('signin', [
    'uses' => 'Controller@signin',
    'as' => 'sign-in'

]);

Route::post('signing-in', [
    'uses' => 'Controller@signingIn',
    'as' => 'signing-in'

]);


Route::post('signing-user', [
    'uses' => 'Controller@signingup',
    'as' => 'signing-up'

]);

Route::get('property{property_id}',[
    'uses' => 'ProductControllerle@show',
    'as' => 'property'

]);

Route::get('subscribed',[
    'uses' => 'Controller@subscribed',
    'as' => 'subscribed'

]);

Route::get('account',[
    'uses' => 'Controller@account',
    'as' => 'account'

]);

Route::post('appointment{property_id}',[
    'uses' => 'MeetingController@set',
    'as' => 'appointment'

]);

Route::get('find',[
    'uses' => 'Controller@find',
    'as' => 'find_property'

]);

Route::get('logout',[
    'uses' => 'Controller@logout',
    'as' => 'logout'

]);

Route::get('post',[
    'uses' => 'Controller@post',
    'as' => 'post_property'

]);


Route::post('search',[
    'uses' => 'ProductControllerle@search',
    'as'   => 'search'

]);

Route::post('posting',[
    'uses' => 'ProductControllerle@posting',
    'as'   => 'post'

]);
//<------------------------------------------------------------------------------->

Route::get('/draw',function () {
    return view('draw2');

});


