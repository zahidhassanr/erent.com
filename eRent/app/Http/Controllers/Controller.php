<?php

namespace App\Http\Controllers;
use App\Meeting;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class Controller extends BaseController
{
    function signup(){
        return view('signup');
    }

    function signingup(Request $request)
    {
        $user=new User;
        $user->name=$request['name'];
        $user->email=$request['email'];

        $dup_user=User::where('email',$user->email)->first();
        if($dup_user)
        {
            return redirect()->back();
        }


        $user->address=$request['address'];
        $user->phone=$request['mobile'];
        $pass=$request['password'];
        $con_pass=$request['password_con'];


//if($pass != $con_pass)
//{
  //  return redirect()->back();

//}
        $user->password=$request['password'];
        $user->save();

        session()->put('name',$user->name);
        session()->put('email',$user->email);
        session()->put('id',$user->id);
        session()->put('property_uploaded',0);
        session()->put('property_chosen',0);
        return redirect()->route('welcome');


    }

    function signin()
    {
        return view('signin');
    }

    function signingIn(Request $request1)
    {
        $email=$request1['email'];
        $password=$request1['password'];
        $user = User::where('email', $email)->first();
        if($email !=null && $password !=null && $user!=null) {


            if ($user->password == $password) {
                if($user->isCustomer && $user->isOwner)
                {
                    $num=0;
                    $meeting=Meeting::where('customer_id',$user->id)->get();
                    foreach($meeting as $meet)
                    {
                        $num++;
                    }
                    $meeting=Meeting::where('owner_id',$user->id)->get();
                    foreach($meeting as $meet)
                    {
                        $num++;
                    }
                    session()->put('property_num',$num);
                    session()->put('property_chosen',($user->property_chosen+$user->property_uploaded));
                    session()->put('property_uploaded',($user->property_chosen+$user->property_uploaded));
                    session()->put('user_type','both');
                }

                else if($user->isCustomer)
                {
                    $num=0;
                    $meeting=Meeting::where('customer_id',$user->id)->get();
                    foreach($meeting as $meet)
                    {
                        $num++;
                    }
                    session()->put('property_num',$num);

                    session()->put('property_chosen',$user->property_chosen);
                    session()->put('user_type','customer');

                }
                else if($user->isOwner)
                {
                    $num=0;
                    $meeting=Meeting::where('owner_id',$user->id)->get();
                    foreach($meeting as $meet)
                    {
                        $num++;
                    }
                    session()->put('property_num',$num);

                    session()->put('property_uploaded',$user->property_uploaded);
                    session()->put('user_type','owner');
                }
                session()->put('name', $user->name);
                session()->put('email', $user->email);
                session()->put('id', $user->id);

                session()->put('login-error','false');

                return redirect()->back();
            }
            else
            {
                session()->put('login-error','true');
                return redirect()->back();
            }
        }
        else
        {
            session()->put('login-error','true');

            return redirect()->back();
        }
    }


    function find()
    {
        return  view('find_property');
    }



    function post()
    {
        return view('post-property');
    }


    function logout()
    {
        session()->put('name',null);
        session()->put('email',null);
        session()->put('id',null);
        session()->put('property_uploaded',0);
        session()->put('property_chosen',0);
        session()->put('user_type','user');
        return redirect()->route('welcome');
    }


    function subscribed()
    {
        return view('appointment');
    }


    function account()
    {
        return view('account');
    }

}



