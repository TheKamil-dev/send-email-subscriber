<?php

namespace App\Console\Commands;

use App\Mail\SubcriberEmailNotification;
use App\Models\CreateEmailAuditLog;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriber:email {post_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to all the subscribers of a website';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $postId = $this->argument('post_id');

        $post =  Post::find($postId);

        //get users
        if(!empty($post))
        {
            $subscribers = Subscriber::where('website_id', $post->website_id)->get();

            foreach($subscribers as $subscriber){
                try {

                        if(
                            CreateEmailAuditLog::where('subscriber_id', $subscriber->id)
                            ->where('post_id', $postId)
                            ->doesntExist()
                        )
                        {
                            Mail::to($subscriber->email)->send(new SubcriberEmailNotification($post));
                            $createLog = new CreateEmailAuditLog();
                            $createLog->subscriber_id = $subscriber->id;
                            $createLog->post_id = $post->id;
                            $createLog->save();
                        }

                } catch (\Throwable $th) {
                   return  $th->getMessage();
                }

            }

        }


        return 0;
    }
}
