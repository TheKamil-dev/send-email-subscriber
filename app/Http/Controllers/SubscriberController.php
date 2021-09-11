<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    //

    public function createSubscription(Request $request)
    {

        $validator =  Validator::make($request->all(),[
            'email' => 'required|email',
            'website_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            $msg = [
                "msg" => $validator->errors(),
                "status" => "fail"
            ];

            return response()->json($msg );
        }


        $website_id = $request->website_id;
        $email = $request->email;

        if(Website::where('id', $website_id)->doesntExist())
        {
            $msg = [
                "msg" => "This Website doesn't Exist!",
                "status" => "fail"
            ];

            return response()->json($msg );
        }

        if(Subscriber::where('email',  $email)->where('website_id', $website_id)->exists())
        {
            $msg = [
                "msg" => "This Email is already subscribed!",
                "status" => "fail"
            ];

            return response()->json($msg );
        }



        $subscriber = new Subscriber();
        $subscriber->email = $email;
        $subscriber->website_id = $website_id;

        $subscriber->save();
        $msg = [
            "msg" =>"User sucessfully Subscribed!",
            "status" => "success"
        ];

        return response()->json($msg );
    }

}
