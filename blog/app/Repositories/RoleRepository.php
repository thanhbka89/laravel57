<?php

namespace App\Repositories;

use App\Role;

class RoleRepository
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function create(array $attributes)
    {
        return $this->role->create($attributes);
    }

    public function all()
    {
        return $this->role->all();
    }

    public function find($id)
    {
       return $this->role->findOrFail($id);
    }

    public function update($id, array $attributes)
    {
        return $this->role->findOrFail($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->role->findOrFail($id)->delete();
    }

    public function paginate($number)
    {
        return $this->role->paginate($number);
    }

    public function latest()
    {
        return $this->role->latest();
    }
}
