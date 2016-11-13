<?php

/**
 * Class UserRepositoryTest
 *
 * @see \App\Http\Requests\UserRegisterRequest
 */
class UserRegisterRequestTest extends \TestCase
{
    /** @var \App\Http\Requests\UserRegisterRequest */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new \App\Http\Requests\UserRegisterRequest;
        $this->request->setContainer($this->app)
            ->setRedirector($this->app['Illuminate\Routing\Redirector']);
    }

    /**
     * @expectedException Illuminate\Validation\ValidationException
     */
    public function testValidateErrorWithoutName()
    {
        $this->request['name'] = '';
        $this->request['email'] = 'testing@test.com';
        $this->request['password'] = 'test1234';
        $this->request['password_confirmation'] = 'test1234';
        $this->request->validate();
    }

    /**
     * @expectedException Illuminate\Validation\ValidationException
     */
    public function testValidateErrorWithoutEmail()
    {
        $this->request['name'] = 'testing';
        $this->request['email'] = '';
        $this->request['password'] = 'test1234';
        $this->request['password_confirmation'] = 'test1234';
        $this->request->validate();
    }

    /**
     * @expectedException Illuminate\Validation\ValidationException
     */
    public function testValidateErrorWithoutPassword()
    {
        $this->request['name'] = 'testing';
        $this->request['email'] = 'testing@test.com';
        $this->request['password'] = '';
        $this->request['password_confirmation'] = 'test1234';
        $this->request->validate();
    }

    /**
     * @expectedException Illuminate\Validation\ValidationException
     */
    public function testValidateErrorPasswordConfirm()
    {
        $this->request['name'] = 'testing';
        $this->request['email'] = 'testing@test.com';
        $this->request['password'] = 'test1234';
        $this->request['password_confirmation'] = 'hogehoge';
        $this->request->validate();
    }

    public function testValidationSuccess()
    {
        $this->request['name'] = 'testing';
        $this->request['email'] = 'testing@test.com';
        $this->request['password'] = 'test1234';
        $this->request['password_confirmation'] = 'test1234';
        $this->assertNull($this->request->validate());
    }
}