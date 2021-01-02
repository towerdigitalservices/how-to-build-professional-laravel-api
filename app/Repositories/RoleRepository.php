<?php
namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}