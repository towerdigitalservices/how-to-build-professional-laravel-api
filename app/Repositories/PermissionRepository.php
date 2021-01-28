<?php
namespace App\Repositories;

use App\Models\Permission;
use TowerDigital\Tools\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }
}