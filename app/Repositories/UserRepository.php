<?php

namespace App\Repositories;

use App\DataAccess\Eloquent\User;

class UserRepository implements UserRepositoryInterface
{
    /** @var User */
    protected $eloquent;

    public function __construct(User $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function create(array $params)
    {
        return $this->eloquent->create($params);
    }
}
