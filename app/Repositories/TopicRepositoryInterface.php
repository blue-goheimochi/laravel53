<?php

namespace App\Repositories;

interface TopicRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getTopic(int $id);
    
    /**
     * @param int $count
     * @return mixed
     */
    public function getNewTopics(int $count);
    
    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params);
}
