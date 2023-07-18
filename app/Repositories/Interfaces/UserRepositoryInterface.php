<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null);
}
