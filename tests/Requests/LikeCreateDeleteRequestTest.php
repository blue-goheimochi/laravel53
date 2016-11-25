<?php

/**
 * Class LikeCreateDeleteRequestTest
 *
 * @see \App\Http\Requests\LikeCreateDeleteRequest
 */
class LikeCreateDeleteRequestTest extends \TestCase
{
    /** @var \App\Http\Requests\LikeCreateDeleteRequest */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new \App\Http\Requests\LikeCreateDeleteRequest;
        $this->request->setContainer($this->app)
            ->setRedirector($this->app['Illuminate\Routing\Redirector']);
    }

    /**
     * @expectedException \Illuminate\Http\Exception\HttpResponseException
     */
    public function testValidateErrorParamEmpty()
    {
        $this->request->validate();
    }

    /**
     * @expectedException \Illuminate\Http\Exception\HttpResponseException
     */
    public function testValidateErrorTopicIdEmpty()
    {
        $this->request['topic_id'] = '';
        $this->request->validate();
    }

    /**
     * @expectedException \Illuminate\Http\Exception\HttpResponseException
     */
    public function testValidateErrorTopicIdNotNumeric()
    {
        $this->request['topic_id'] = 'string';
        $this->request->validate();
    }

    /**
     * @expectedException \Illuminate\Http\Exception\HttpResponseException
     */
    public function testValidateErrorTopicNotExists()
    {
        $this->request['topic_id'] = '999';
        $this->request->validate();
    }

    public function testValidateSuccess()
    {
        $this->request['topic_id'] = '1';
        $this->request->validate();
    }
}