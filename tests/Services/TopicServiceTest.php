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
            new StubTopicServiceRepository,
            new StubLikeServiceRepository
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

    public function testGetNewTopics()
    {
        $topics = $this->service->getNewTopics(5);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $topics);
        $this->assertEquals(5, $topics->count());
    }
      
    public function testCreateLike()
    {
        $user_id  = 1;
        $topic_id = 1;
        $like = $this->service->createLike($user_id, $topic_id);

        $this->assertInstanceOf('App\DataAccess\Eloquent\Like', $like);
    }

    public function testDeleteLike()
    {
        $user_id  = 1;
        $topic_id = 1;
        $result = $this->service->deleteLike($user_id, $topic_id);

        $this->assertInternalType('int', $result);
        $this->assertEquals(1, $result);

        $user_id  = 2;
        $topic_id = 2;
        $result = $this->service->deleteLike($user_id, $topic_id);

        $this->assertInternalType('int', $result);
        $this->assertEquals(0, $result);
    }

    public function testIsLiked()
    {
        $user_id  = 1;
        $topic_id = 1;
        $result = $this->service->isLiked($user_id, $topic_id);

        $this->assertTrue($result);

        $user_id  = 2;
        $topic_id = 2;
        $result = $this->service->isLiked($user_id, $topic_id);

        $this->assertFalse($result);
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
    
    /**
     * @param array $params
     *
     * @return mixed
     */
    public function getNewTopics(int $count)
    {
        return factory(\App\DataAccess\Eloquent\Topic::class, $count)->make();
    }
}

class StubLikeServiceRepository implements \App\Repositories\LikeRepositoryInterface
{
    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params)
    {
        return factory(\App\DataAccess\Eloquent\Like::class)->make($params);
    }

    /**
     * @param int $user_id
     * @param int $topic_id
     * @return int
     */
    public function delete(int $user_id, int $topic_id)
    {
        if( $user_id == 2 && $topic_id = 2 ) {
          return 0;
        }
        return 1;
    }

    /**
     * @param int $user_id
     * @param int $topic_id
     * @return bool
     */
    public function isLiked(int $user_id, int $topic_id)
    {
        if( $user_id == 2 && $topic_id = 2 ) {
          return false;
        }
        return true;
    }
}