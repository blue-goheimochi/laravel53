<?php

use Mockery as m;

/**
 * Class UserServiceTest
 *
 * @see \App\Services\UserService
 */
class UserServiceTest extends \TestCase
{
    /** @var \App\Services\UserService */
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new \App\Services\UserService(
            new StubUserServiceRepository
        );
    }

    public function testRegisterUser()
    {
        $user = $this->service->registerUser([
            'name'     => 'testing',
            'email'    => 'testing@test.com',
            'password' => bcrypt('test1234')
        ]);

        $this->assertInstanceOf('App\DataAccess\Eloquent\User', $user);
    }
}

class StubUserServiceRepository implements \App\Repositories\UserRepositoryInterface
{
    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return factory(\App\DataAccess\Eloquent\User::class)->make($params);
    }

}