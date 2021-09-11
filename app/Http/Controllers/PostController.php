<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Jobs\SendEmailNotificationJob;
use App\Mail\SubcriberEmailNotification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function createPost(Request $request)
    {

        $validator =  Validator::make($request->all(),[
            'title' => 'required|max:255',
            'description' => 'required',
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
        $title = $request->title;
        $description = $request->description;


        $post = new Post();
        $post->title = $title;
        $post->description = $description;
        $post->website_id = $website_id;

        $post->save();


        $msg = [
            "data"=>$post,
            "msg" =>"Post Created Successfully!",
            "status" => "success"
        ];
        //PostCreated::dispatch($post);

        dispatch(new SendEmailNotificationJob($post));

        // For schedule Job queue.
        //dispatch(new SendEmailNotificationJob($post))->delay(now()->addMinutes(10));

        return response()->json($msg);
    }
}
