<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Transformers\RoleTransformer;
use App\Repositories\RoleRepository;
use App\Http\Requests\Authorization\CreateRoleRequest;
use App\Http\Requests\Authorization\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * @property RoleRepository
     */
    protected $roles;

    public function __construct(
        RoleTransformer $transformer,
        RoleRepository $roles,
        Request $request)
    {
        parent::__construct($transformer, $request);

        $this->roles = $roles;
    }

    public function index()
    {
        return $this->respondWithCollection($this->roles->all());
    }

    public function create(CreateRoleRequest $request)
    {
        $role = $this->roles->create($request->validated());
        return $this->respondWithItem($role, 201);
    }

    public function show(string $id)
    {
        $role = $this->roles->byId($id);
        return $this->respondWithItem($role);
    }

    public function update(string $id, UpdateRoleRequest $request)
    {
        $role = $this->roles->update($id, $request->validated());
        return $this->respondWithItem($role);
    }

    public function delete(string $id)
    {
        $this->roles->delete($id);
        return $this->respondWithMessage('Successfully deleted role.');
    }
}
