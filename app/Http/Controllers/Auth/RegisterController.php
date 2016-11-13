<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\AuthManager;
use App\Services\UserService;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $auth)
    {
        $this->middleware('guest');
        $this->auth = $auth;
    }

    public function register(UserRegisterRequest $request, UserService $userService)
    {
        $user = $userService->registerUser($request->all());
        event(new Registered($user));

        $this->auth->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
