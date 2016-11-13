<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\AuthManager;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /** @var AuthManager */
    protected $auth;

    /** @var UserRepositoryInterface */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $auth, UserRepositoryInterface $user)
    {
        $this->middleware('guest');
        $this->auth = $auth;
        $this->user = $user;
    }

    public function register(UserRegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->auth->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
