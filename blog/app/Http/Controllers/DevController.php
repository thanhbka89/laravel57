<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use Cache;
use DB;
use Illuminate\Http\Request;
use App\Events\TestEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailablePost;
use App\Mail\OrderShipped;
use App\User;

class DevController extends Controller
{
    function __construct () {

    }

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
           Log::info('Email was sent');

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

    public function testNonCache()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function testUseCache()
    {
        $users = Cache::remember('users', 22*60, function() {
            return User::all();
        });

        return response()->json($users);
    }

    #Generator
    private function myGenerator($max) {
        $array = [];
        for ($i=0; $i < $max; $i++) {
            //$array[] = $i;
            yield $i;
        }
        //return $array;

    }

    public function testGenerator() {
        $start_time = microtime(true);
        $total = 0;
        foreach ($this->myGenerator(1000000) as $value) {
            $total += $value;
        }
        $end_time = microtime(true);
        echo "Total: ", $total, PHP_EOL;
        echo "Thời gian thực hiện: ", bcsub($end_time, $start_time, 4), PHP_EOL;
        echo "Bộ nhớ sử dụng (kb): ", memory_get_peak_usage(true)/1024, PHP_EOL;
    }

    public function testQueryBuilder($value='')
    {
        #get column in table
        $users = DB::table('users')->pluck('id', 'name');

        return response()->json($users);
    }

    public function testAccessor($value='')
    {
        #get column in table
        $user = User::findorfail(1);

        return response()->json($user->full_name);
    }

    public function testBenmarkBuildAndORM($value='')
    {
        #use Eloquent ORM
        $start_time = microtime(true);
        $users = User::all();
        $end_time = microtime(true);
        echo "Thời gian thực hiện Eloquent ORM: ", bcsub($end_time, $start_time, 4), PHP_EOL;
        echo "Bộ nhớ sử dụng (kb): ", memory_get_peak_usage(true)/1024, PHP_EOL;
        echo '<br>------<br>';

        #use QueryBuilder
        $start_time = microtime(true);
        $users = DB::table('users')->get();
        $end_time = microtime(true);
        echo "Thời gian thực hiện QueryBuilder: ", bcsub($end_time, $start_time, 4), PHP_EOL;
        echo "Bộ nhớ sử dụng (kb): ", memory_get_peak_usage(true)/1024, PHP_EOL;
        echo '<br>------<br>';
    }
}
