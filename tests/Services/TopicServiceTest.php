<?php

use Mockery as m;

/**
 * Class TopicServiceTest
 *
 * @see \App\Services\TopicService
 */
class TopicServiceTest extends \TestCase
{
    /** @var \App\Services\TopicService */
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = new \App\Services\TopicService(
            new StubTopicServiceRepository
        );
    }

    public function testCreateTopic()
    {
        $topic = $this->service->createTopic([
            'user_id' => 1,
            'title'   => 'Test Title',
            'body'    => 'Test Body',
        ]);

        $this->assertInstanceOf('App\DataAccess\Eloquent\Topic', $topic);
    }

    public function testGetTopic()
    {
        $topic = $this->service->getTopic(1);

        $this->assertInstanceOf('App\DataAccess\Eloquent\Topic', $topic);
    }
}

class StubTopicServiceRepository implements \App\Repositories\TopicRepositoryInterface
{
    /**
     * @param array $params
     *
     * @return mixed
     */
    public function getTopic(int $id)
    {
        return factory(\App\DataAccess\Eloquent\Topic::class)->make();
    }
    
    /**
     * @param array $params
     *
     * @return mixed
     */
    public function create(array $params)
    {
        return factory(\App\DataAccess\Eloquent\Topic::class)->make($params);
    }
}