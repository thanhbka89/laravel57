<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $attributes)
    {
        return $this->user->create($attributes);
    }

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
       return $this->user->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->user->findOrFail($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->user->findOrFail($id)->delete();
    }

    public function paginate($number)
    {
        return $this->user->paginate($number);
    }

    public function latest()
    {
        return $this->user->latest();
    }
}
