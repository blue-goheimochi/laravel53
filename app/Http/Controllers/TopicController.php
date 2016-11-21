<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicCreateRequest;
use App\Repositories\TopicRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\TopicService;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Redirect;

class TopicController extends Controller
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
    
    public function getTopic(int $id, TopicService $topicService)
    {
        $topic = $topicService->getTopic($id);
        return view('topic.detail', ['topic' => $topic]);
    }
    
    public function getNewTopic()
    {
        return view('topic.new');
    }
    
    public function postNewTopic(TopicCreateRequest $request, TopicService $topicService)
    {
        $inputs = $request->all();
        $user   = $this->auth->user();
        
        $params = [
            'user_id' => $user->id,
            'title'   => $inputs['title'],
            'body'    => $inputs['body'],
        ];
        $newTopic = $topicService->createTopic($params);
        
        return Redirect::to('/topic/' . $newTopic->id)->with('status', 'トピックが投稿されました');
    }
    
    public function getCompleteTopic($id)
    {
        return view('topic.complete', ['id' => $id]);
    }
}
