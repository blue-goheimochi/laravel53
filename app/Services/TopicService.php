<?php

namespace App\Services;

use App\Repositories\TopicRepositoryInterface;

/**
 * Class UserService
 * @package App\Service
 */
class TopicService
{
    /** @var TopicRepositoryInterface */
    protected $topic;

    /**
     * @param TopicRepositoryInterface $topic
     */
    public function __construct(TopicRepositoryInterface $topic)
    {
        $this->topic = $topic;
    }

    /**
     * @param int $id
     * @return \App\DataAccess\Eloquent\Topic
     */
    public function getTopic(int $id)
    {
        $topic = $this->topic->getTopic($id);
        return $topic;
    }

    /**
     * @param array $params
     * @return \App\DataAccess\Eloquent\Topic
     */
    public function createTopic(array $params)
    {
        $topic = $this->topic->create([
            'user_id' => $params['user_id'],
            'title'   => $params['title'],
            'body'    => $params['body'],
        ]);
        return $topic;
    }
}
