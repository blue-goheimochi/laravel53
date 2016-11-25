<?php

use Mockery as m;

/**
 * Class LikeRepositoryTest
 *
 * @see \App\Repositories\LikeRepository
 */
class LikeRepositoryTest extends \TestCase
{
    public function testCreateLike()
    {
        $likeAliasMock = m::mock('alias:App\DataAccess\Eloquent\Like');

        $like = new stdClass;
        $like->id       = 1;
        $like->user_id  = 1;
        $like->topic_id = 1;

        $likeAliasMock->shouldReceive('firstOrCreate')->andReturn($like);
        $repository = new \App\Repositories\LikeRepository(
            $likeAliasMock
        );
        $result = $repository->create([
            'user_id'  => 1,
            'topic_id' => 1,
        ]);
        
        $this->assertEquals(1, $result->id);
        $this->assertEquals(1, $result->user_id);
        $this->assertEquals(1, $result->topic_id);
    }
    
    public function testDeleteLike()
    {
        // 削除するデータが存在した場合、削除したレコード数を返す
        $likeAliasMock = m::mock('alias:App\DataAccess\Eloquent\Like');
        $likeAliasMock
            ->shouldReceive('where')->with('user_id', 1)->andReturn(m::self())->getMock()
            ->shouldReceive('where')->with('topic_id', 1)->once()->andReturn(m::self())->getMock()
            ->shouldReceive('delete')
            ->andReturn(1);
        $repository = new \App\Repositories\LikeRepository(
            $likeAliasMock
        );
        $user_id  = 1;
        $topic_id = 1;
        $result = $repository->delete($user_id, $topic_id);
        $this->assertEquals(1, $result);
        
        // 削除するデータが存在しない場合、0を返す
        $likeAliasMock2 = m::mock('alias:App\DataAccess\Eloquent\Like');
        $likeAliasMock2
            ->shouldReceive('where')->with('user_id', 2)->andReturn(m::self())->getMock()
            ->shouldReceive('where')->with('topic_id', 2)->once()->andReturn(m::self())->getMock()
            ->shouldReceive('delete')
            ->andReturn(0);
        $repository2 = new \App\Repositories\LikeRepository(
            $likeAliasMock2
        );
        $user_id  = 2;
        $topic_id = 2;
        $result = $repository2->delete($user_id, $topic_id);
        $this->assertEquals(0, $result);
    }
    
    public function testIsLiked()
    {
        // すでにいいねしている場合、trueを返す
        $likeAliasMock = m::mock('alias:App\DataAccess\Eloquent\Like');
        $likeAliasMock
            ->shouldReceive('where')->with('user_id', 1)->andReturn(m::self())->getMock()
            ->shouldReceive('where')->with('topic_id', 1)->once()->andReturn(m::self())->getMock()
            ->shouldReceive('exists')
            ->andReturn(true);
        $repository = new \App\Repositories\LikeRepository(
            $likeAliasMock
        );
        $user_id  = 1;
        $topic_id = 1;
        $result = $repository->isLiked($user_id, $topic_id);
        $this->assertTrue($result);
        
        // いいねしている場合、falseを返す
        $likeAliasMock2 = m::mock('alias:App\DataAccess\Eloquent\Like');
        $likeAliasMock2
            ->shouldReceive('where')->with('user_id', 2)->andReturn(m::self())->getMock()
            ->shouldReceive('where')->with('topic_id', 2)->once()->andReturn(m::self())->getMock()
            ->shouldReceive('exists')
            ->andReturn(false);
        $repository2 = new \App\Repositories\LikeRepository(
            $likeAliasMock2
        );
        $user_id  = 2;
        $topic_id = 2;
        $result = $repository2->isLiked($user_id, $topic_id);
        $this->assertFalse($result);
    }
}