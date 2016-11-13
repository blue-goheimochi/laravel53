<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params);
}
