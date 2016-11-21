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
     * @param array $params
     * @return mixed
     */
    public function create(array $params);
}
