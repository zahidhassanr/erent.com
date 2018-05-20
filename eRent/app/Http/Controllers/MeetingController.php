<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Meeting;
use App\Owner;
use App\Properties;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MeetingController extends Controller
{
    function set(Request $request,$property_id)
    {
        $customer=new Customer;
        $customer->customer_id=session()->get('id');
        $customer->properties_id=$property_id;
        $customer->save();


        $user=User::where('id',session()->get('id'))->first();
        DB::table('users')->where('id',$user->id)->increment('property_chosen');

        $user=User::where('id',session()->get('id'))->first();
        $property_chosen=$user->property_chosen;

        DB::table('users')
            ->where('id', session()->get('id'))
            ->update(['isCustomer'=> 1]);


        if(session()->get('user_type')=="owner" || session()->get('user_type')=="both")
        {
            session()->put('user_type','both');
        }
        else {
            session()->put('user_type', 'customer');
        }
        session()->put('property_chosen',$property_chosen);

        $num=session()->get('property_num');
        $num=$num+1;
        session()->put('property_num',$num);
        $owner=Owner::where('properties_id',$property_id)->first();



        $owner1=User::where('id',$owner->owner_id)->first();

        $meeting=new Meeting;
        $meeting->customer_id=$customer->customer_id;
        $meeting->customer_phone=$request['phone'];
        $meeting->owner_id=$owner->owner_id;
        $meeting->owner_phone=$owner1->phone;
        $meeting->employee_id=rand(1,4);
        $meeting->properties_id=$property_id;
        $meeting->meeting_date=$request['date'];
        $meeting->meeting_time=$request['time'];
        $meeting->timestamps = false;
        $meeting->save();

        return redirect()->back();
    }
}
