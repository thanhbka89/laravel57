<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Events\TestEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailablePost;
use App\Mail\OrderShipped;
use App\User;

class DevController extends Controller
{
	public function testEvent(){
		try {

			Log::info('=== Hello Event and Queue  ========');
			event(new TestEvent());

			return 'hello';
		} catch(Exception $ex) {
			Log::info('Error'. $e->getMessage());

			return $ex;
		}
	}

	public function mail(){
		try {

		   $name = 'Krunal';
		   Mail::to('krunal@appdividend.com')->send(new SendMailablePost($name));
		   
		   return 'Email was sent';
		} catch(Exception $ex) {
			Log::info('Error'. $e->getMessage());

			return $ex;
		}
	}

	#send email using Markdown Mailables
	public function sendMailMarkdown()
	{
		$content = [
    		'title'=> 'Itsolutionstuff.com mail', 
    		'body'=> 'The body of your message.',
    		'button' => 'Click Here'
    		];
    	$receiverAddress = 'thanhnm@gmail.com';
    	Mail::to($receiverAddress)->send(new OrderShipped($content));
    	dd('mail send successfully');
	}

	#Chunk() method for big tables
	public function chunkUser($value='')
	{
		User::chunk(100, function ($users) {
			$i = 1;
		    foreach ($users as $user) {
			    echo $i . $user->name . '<br>';
			    $i++;
			}
		});
	}
}
