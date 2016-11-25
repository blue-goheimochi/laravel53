<?php

namespace App\Repositories;

use App\DataAccess\Eloquent\Like;

class LikeRepository implements LikeRepositoryInterface
{
    /** @var Like */
    protected $eloquent;

    public function __construct(Like $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function create(array $params)
    {
        return $this->eloquent->firstOrCreate($params);
    }

    public function delete(int $user_id, int $topic_id)
    {
        return $this->eloquent->where('user_id', $user_id)->where('topic_id', $topic_id)->delete();
    }

    public function isLiked(int $user_id, int $topic_id)
    {
        return $this->eloquent->where('user_id', $user_id)->where('topic_id', $topic_id)->exists();
    }
}
