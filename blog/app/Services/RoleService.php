<?php

namespace App\Services;

use Hash;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleService
{
	public function __construct(RoleRepository $roleRespository)
	{
		$this->role = $roleRespository ;
	}

	public function index()
	{
		return $this->role->all();
	}

	public function create(Request $request)
	{
        $attributes = ['name' => $request->input('name')];

		return $this->role->create($attributes);
	}

	public function read($id)
	{
		return $this->role->find($id);
	}

	public function update(Request $request, $id)
	{
		$attributes = $request->all();

        if(!empty($attributes['password'])){
            $attributes['password'] = Hash::make($attributes['password']);
        }else{
            $attributes = array_except($attributes, array('password'));
        }

		return $this->role->update($id, $attributes);
	}

	public function delete($id)
	{
		return $this->role->delete($id);
	}

    public function paginate($number)
    {
        return $this->role->latest()->paginate($number);
    }
}
