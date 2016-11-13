<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    /** @var UserRepositoryInterface */
    protected $user;

    /**
     * @param UserRepositoryInterface $User
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $params
     * @return \App\DataAccess\Eloquent\User
     */
    public function registerUser(array $params)
    {
        $user = $this->user->create([
            'name'     => $params['name'],
            'email'    => $params['email'],
            'password' => bcrypt($params['password']),
        ]);
        return $user;
    }
}
