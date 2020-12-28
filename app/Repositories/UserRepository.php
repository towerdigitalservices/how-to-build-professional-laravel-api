<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function create(Array $data): Model
    {
        $user = $this->model->fill($data);
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }

    public function updatePassword(String $userId,String $password): bool
    {
        $user = $this->byId($userId);
        $user->password = Hash::make($password);
        $user->save();
        return true;
    }

}