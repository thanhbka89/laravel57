<?php

namespace App\Services;

use Hash;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{
	public function __construct(UserRepository $userRespository)
	{
		$this->user = $userRespository ;
	}

	public function index()
	{
		return $this->user->all();
	}

	public function create(Request $request)
	{
		$attributes = $request->all();
        $attributes['password'] = Hash::make($attributes['password']);

		return $this->user->create($attributes);
	}

	public function read($id)
	{
		return $this->user->find($id);
	}

	public function update(Request $request, $id)
	{
		$attributes = $request->all();

        if(!empty($attributes['password'])){
            $attributes['password'] = Hash::make($attributes['password']);
        }else{
            $attributes = array_except($attributes, array('password'));
        }

		return $this->user->update($id, $attributes);
	}

	public function delete($id)
	{
		return $this->user->delete($id);
	}

    public function paginate($number)
    {
        return $this->user->latest()->paginate($number);
    }
}
