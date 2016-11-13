<?php

use Mockery as m;

/**
 * Class UserRepositoryTest
 *
 * @see \App\Repositories\UserRepository
 */
class UserRepositoryTest extends \TestCase
{
    public function testCreateUser()
    {
        $userAliasMock = m::mock('alias:App\DataAccess\Eloquent\User');

        $user = new stdClass;
        $user->name     = 'testing';
        $user->email    = 'testing';
        $user->password = bcrypt('testing');

        $userAliasMock->shouldReceive('create')->andReturn($user);
        $repository = new \App\Repositories\UserRepository(
            $userAliasMock
        );
        $result = $repository->create([
            'name'     => 'testing',
            'email'    => 'testing',
            'password' => 'testing'
        ]);
        $this->assertTrue(\Hash::check('testing', $result->password));
    }
}