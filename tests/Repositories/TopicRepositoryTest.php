<?php

use Mockery as m;

/**
 * Class TopicRepositoryTest
 *
 * @see \App\Repositories\TopicRepository
 */
class TopicRepositoryTest extends \TestCase
{
    public function testCreateTopic()
    {
        $topicAliasMock = m::mock('alias:App\DataAccess\Eloquent\Topic');

        $topic = new stdClass;
        $topic->id      = 1;
        $topic->user_id = 1;
        $topic->title   = 'Test Title';
        $topic->body    = 'Test Body';
        $topic->status  = 1;

        $topicAliasMock->shouldReceive('create')->andReturn($topic);
        $repository = new \App\Repositories\TopicRepository(
            $topicAliasMock
        );
        $result = $repository->create([
            'user_id' => 1,
            'title'   => 'Test Title',
            'body'    => 'Test Body',
            'status'  => 1,
        ]);
        $this->assertEquals(1, $result->id);
        $this->assertEquals(1, $result->user_id);
        $this->assertEquals('Test Title', $result->title);
        $this->assertEquals('Test Body', $result->body);
        $this->assertEquals(1, $result->status);
    }
    
    public function testGetTopic()
    {
        $topicAliasMock = m::mock('alias:App\DataAccess\Eloquent\Topic');

        $topic = new stdClass;
        $topic->id      = 1;
        $topic->user_id = 1;
        $topic->title   = 'Test Title';
        $topic->body    = 'Test Body';
        $topic->status  = 1;

        $topicAliasMock
            ->shouldReceive('where')->with('id', 1)->once()->andReturn(m::self())->getMock()
            ->shouldReceive('where')->with('status', 1)->once()->andReturn(m::self())->getMock()
            ->shouldReceive('firstOrFail')
            ->andReturn($topic);
            
        $repository = new \App\Repositories\TopicRepository(
            $topicAliasMock
        );
        $result = $repository->getTopic(1);
        $this->assertEquals(1, $result->id);
        $this->assertEquals(1, $result->user_id);
        $this->assertEquals('Test Title', $result->title);
        $this->assertEquals('Test Body', $result->body);
        $this->assertEquals(1, $result->status);
    }
    
    public function testGetNewTopics()
    {
        $topicAliasMock = m::mock('alias:App\DataAccess\Eloquent\Topic');

        $topic = new stdClass;
        $topic->id      = 1;
        $topic->user_id = 1;
        $topic->title   = 'Test Title';
        $topic->body    = 'Test Body';
        $topic->status  = 1;
        
        $count = 3;
        $topics = factory(\App\DataAccess\Eloquent\Topic::class, $count)->make();;
        $topicAliasMock
            ->shouldReceive('where')->with('status', 1)->once()->andReturn(m::self())->getMock()
            ->shouldReceive('orderBy')->with('created_at', 'DESC')->once()->andReturn(m::self())->getMock()
            ->shouldReceive('take')->with($count)->andReturn(m::self())->getMock()
            ->shouldReceive('get')
            ->andReturn($topics);
            
        $repository = new \App\Repositories\TopicRepository(
            $topicAliasMock
        );
        $result = $repository->getNewTopics($count);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $result);
        $this->assertEquals(3, $result->count());
    }
}