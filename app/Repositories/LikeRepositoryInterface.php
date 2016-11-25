<?php

namespace App\Repositories;

interface LikeRepositoryInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params);

    /**
     * @param int $user_id
     * @param int $topic_id
     * @return int
     */
    public function delete(int $user_id, int $topic_id);

    /**
     * @param int $user_id
     * @param int $topic_id
     * @return bool
     */
    public function isLiked(int $user_id, int $topic_id);
}
