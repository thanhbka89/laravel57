<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Post;
use App\Mail\SendMailablePost;

class SendPostEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $data= array(
               'title'=> $this->post->title,
               'body'=> $this->post->body,
            );

            #Cach 1
            // Mail::send('emails.post', $data, function($message){
            //     $message->from('info@eduonix.com', 'Laravel Queues');
            //     $message->to('sabeer@yahoo.com')->subject('There is a new post');
            // });
            
            #Cach 2 : https://appdividend.com/2018/03/05/send-email-in-laravel-tutorial/
            $name = 'thanhbka';
            Mail::to('krunal@appdividend.com')->send(new SendMailablePost($name));
            Log::info('Email was sent');
        } catch(Exception $ex) {
            Log::info('Error SendMailPost '. $e->getMessage());
        }
    }
}
