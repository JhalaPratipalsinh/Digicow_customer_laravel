<?php
namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null) : User
    {
        if (!isset($id)) {
            $user = new User($data);
        } else {
            $user = User::find($id);

            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
        }
        $user->save();
        return $user;
    }
}
