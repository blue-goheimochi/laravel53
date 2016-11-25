<?php

namespace App\Services;

use App\Repositories\TopicRepositoryInterface;
use App\Repositories\LikeRepositoryInterface;

/**
 * Class UserService
 * @package App\Service
 */
class TopicService
{
    /** @var TopicRepositoryInterface */
    protected $topic;
    
    /** @var LikeRepositoryInterface */
    protected $like;

    /**
     * @param TopicRepositoryInterface $topic
     */
    public function __construct(TopicRepositoryInterface $topic, LikeRepositoryInterface $like)
    {
        $this->topic = $topic;
        $this->like  = $like;
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
     * @param int $id
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getNewTopics(int $count)
    {
        $topics = $this->topic->getNewTopics($count);
        return $topics;
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
    
    /**
     * @param int $user_id
     * @param int $topic_id
     * @return \App\DataAccess\Eloquent\Like
     */
    public function createLike(int $user_id, int $topic_id)
    {
        $like = $this->like->create([
            'user_id'  => $user_id,
            'topic_id' => $topic_id
        ]);
        return $like;
    }

    /**
     * @param int $user_id
     * @param int $topic_id
     * @return \App\DataAccess\Eloquent\Like
     */
    public function deleteLike(int $user_id, int $topic_id)
    {
        $like = $this->like->delete($user_id, $topic_id);
        return $like;
    }

    /**
     * @param int $user_id
     * @param int $topic_id
     * @return bool
     */
    public function isLiked(int $user_id, int $topic_id)
    {
        return $this->like->isLiked($user_id, $topic_id);
    }
}
