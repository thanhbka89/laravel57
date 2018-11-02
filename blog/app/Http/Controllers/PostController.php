<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Requests\PostRequest; //PostRequest class for validation 
use App\Repositories\PostRepositoryInterface;
use App\Jobs\SendPostEmail; //use Queue job

class PostController extends Controller
{
    protected $postservice;
    protected $post;
 
	public function __construct(PostService $postservice, PostRepositoryInterface $post)
    {
	 	$this->postservice = $postservice;
	 	$this->post = $post;
	}

    public function index() 
    {      
	    //$posts = $this->postservice->index();
	    $posts = $this->post->all();
	     
	    return view('post.index', compact('posts'));
    }
 
    public function create(PostRequest $request)
    {
      $post = $this->postservice->create($request);

      dispatch(new SendPostEmail($post)); //Dispatching Jobs to Queue
 
      return back()->with(['status'=>'Post created successfully']);
    }
 
    public function read($id)
    {
       
       $post = $this->postservice->read($id);
 
       return view('post.edit', compact('post'));
 
    }
 
    public function update(PostRequest $request, $id)
    {
 
       $post = $this->postservice->update($request, $id);
 
     	return redirect()->back()->with('status', 'Post has been updated succesfully');
    }
 
    public function delete($id)
    {
	     $this->postservice->delete($id);
	 
	     return back()->with(['status'=>'Deleted successfully']);
    }
}
