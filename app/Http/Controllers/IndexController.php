<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\TopicRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\TopicService;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
    /** @var AuthManager */
    protected $auth;

    /** @var UserRepositoryInterface */
    protected $user;

    /** @var TopicRepositoryInterface */
    protected $topic;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(AuthManager $auth, UserRepositoryInterface $user, TopicRepositoryInterface $topic)
    {
        $this->auth  = $auth;
        $this->user  = $user;
        $this->topic = $topic;
    }
    
    public function getIndex(TopicService $topicService)
    {
        $topics = $topicService->getNewTopics(10);
        return view('index', ['topics' => $topics]);
    }
}
