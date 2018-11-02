<?php

namespace App\Services;

use App\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostService
{
	public function __construct(PostRepository $post)
	{
		$this->post = $post ;
	}

	public function index()
	{
		return $this->post->all();
	}

	public function create(Request $request)
	{
		$attributes = $request->all();

		return $this->post->create($attributes);
	}

	public function read($id)
	{
		return $this->post->find($id);
	}

	public function update(Request $request, $id)
	{
		$attributes = $request->all();

		return $this->post->update($id, $attributes);
	}

	public function delete($id)
	{
		return $this->post->delete($id);
	}
}