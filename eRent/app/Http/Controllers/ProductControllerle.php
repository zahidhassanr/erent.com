<?php

namespace App\Http\Controllers;
use App\Owner;
use App\Properties;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Property;

class ProductControllerle extends Controller
{
    function show($property_id)
    {
        $product=Properties::where('id',$property_id)->first();
        return view('property',['property_id' => $product]);
    }

    function search(Request $request)
    {
        $type=null;
        $district=strtolower($request['district']);
        $location=strtolower($request['area']);
        $min_price=$request['minprice'];
        $max_price=$request['maxprice'];
        $property_type=$request['property_type'];
        if($property_type=="buyflat")
        {
            $property_type="flat";
            $type="sell";
        }

        if($property_type=="rentflat")
        {
            $property_type="flat";
            $type="rent";
        }

        if($property_type=="buyplot")
        {
            $property_type="plot";
            $type="sell";
        }

        if($property_type=="com-area")
        {
            $property_type="com-area";
            $type="rent";
        }
        $property=Properties::where([

            ['district','=',$district],
            ['location','=',$location],
            ['property_type','=',$property_type],
            ['sale_type','=',$type],
            ['price','>',$min_price],
            ['price','<',$max_price]
        ])->get();



        return view('search',['property' => $property,'district' => $district,'location'  => $location,'property_type' => $property_type
            ,'type' => $type,'min_price' => $min_price,
            'max_price' => $max_price]);
    }



    function posting(Request $request1)
    {

        $request1->validate([
            'type_radio' => 'required',
            'property_name' => 'required',
           // 'apart_parking' => 'required',
            //'comm_parking' => 'required',
            'city_name' => 'required',
            'location_name' => 'required',
            'description_name' => 'required',
            'file' => 'required',
            'bedroom_num' => 'numeric|min:0|max:10|required',
            'drawroom_num' => 'numeric|min:0|max:10|required',
            'dinroom_num' => 'numeric|min:0|max:10|required',
            'toilet' => 'numeric|min:0|max:10|required',
            'area_flat' => 'numeric|min:0|required',
            'service_flat' => 'numeric|min:0|required',
            'area_plot' => 'numeric|numeric|min:0|required',
            'price_plot' => 'numeric|min:0|required',
            'area_comm' => 'numeric|min:0|required',
            'price_comm' => 'numeric|min:0|required',
            'service_comm' => 'numeric|min:0|required',

        ]);


        $email=$request1['email'];
        $password=$request1['password'];

        $user=User::where([

            ['email','=',$email],
            ['password','=',$password]
        ])->first();

        $type_select=$request1['type_select'];
        $type=$request1['type_radio'];
        $name=$request1['property_name'];
        $bed=$request1['bedroom_num'];
        $draw=$request1['drawroom_num'];
        $din=$request1['dinroom_num'];
        $toilet=$request1['toilet'];
        $apart_park=$request1['apart_parking'];
        $area_flat=$request1['area_flat'];
        $price_flat=$request1['price_flat'];
        $service_flat=$request1['service_flat'];

        $area_plot=$request1['area_plot'];
        $price_plot=$request1['price_plot'];

        $comm_parking=$request1['comm_parking'];
        $area_comm=$request1['area_comm'];
        $price_comm=$request1['price_comm'];
        $service_comm=$request1['service_comm'];

        $city_name=$request1['city_name'];
        $location_name=$request1['location_name'];

        $description_name=$request1['description_name'];

        $file=$request1['file'];

        $property=new Properties;

        if($type_select=="flat")
        {
            $property->name=$name;
            $property->imageUrl="images/".$file;
            $property->description=$description_name;
            $property->bedrooms=$bed;
            $property->drawingrooms=$draw;
            $property->diningrooms=$din;
            $property->toilet=$toilet;
            $property->price=$price_flat;
            $property->servicecharge=$service_flat;
            $property->area=$area_flat;
            if($apart_park=="yes")
            {
                $property->parking=1;

            }
            else{
                $property->parking=0;
            }
            $property->x_coordinate=23.89;
            $property->y_coordinate=90.41;
            $property->district=$city_name;
            $property->location=$location_name;
            $property->property_type="flat";
            $property->sale_type=$type;

        }

        else if($type_select=="plot")
        {
            $property->name=$name;
            $property->imageUrl="images/".$file;
            $property->description=$description_name;
            $property->price=$price_plot;
            $property->area=$area_plot;
            $property->x_coordinate=23.89;
            $property->y_coordinate=90.41;
            $property->district=$city_name;
            $property->location=$location_name;
            $property->property_type="plot";
            $property->sale_type=$type;

        }
        else{
            $property->name=$name;
            $property->imageUrl="images/".$file;
            $property->description=$description_name;
            $property->price=$price_comm;
            $property->area=$area_comm;
            $property->x_coordinate=23.89;
            $property->y_coordinate=90.41;
            $property->district=$city_name;
            $property->location=$location_name;
            $property->property_type="com-area";
            $property->sale_type=$type;
            if($comm_parking=="yes")
            {
                $property->parking=1;

            }
            else{
                $property->parking=0;
            }

            $property->servicecharge=$service_comm;
        }



        if(!$user)
        {
            echo "Email or password is not correct";
            return redirect()->back();

        }
        else{
           // $property_uploaded=$user->property_uploaded;
            //$property_uploaded=$property_uploaded+1;
            DB::table('users')
                ->where('id', $user->id)
                ->update(['isOwner'=> 1]);

            DB::table('users')->where('id',$user->id)->increment('property_uploaded');
        }
        $property->save();
        $owner=new Owner;
        $owner->owner_id=$user->id;
        $owner->properties_id=$property->id;
        $owner->save();
        session()->put('property_uploaded',$user->property_uploaded);

        if(session()->get('user_type')=="customer" || session()->get('user_type')=="both")
        {
            session()->put('user_type',"both");

        }
        else{
            session()->put('user_type',"owner");

        }
       // return redirect()->back();
       return redirect()->route('welcome');

    }

}
