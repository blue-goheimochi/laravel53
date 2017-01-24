<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    /** @var AuthManager */
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $auth)
    {
        $this->middleware('auth:admin');
    }
    
    public function getIndex()
    {
        return view('admin.index');
    }
}
