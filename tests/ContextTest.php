<?php

use Behat\Mink\Selector\SelectorsHandler;
use Behat\Mink\Session;
use Example\Demo;
use Goez\PageObjects\Context;

class ContextTest extends PHPUnit_Framework_TestCase
{
    private $session;

    public function setUp()
    {
        $driver = Mockery::mock(CoreDriver::class);
        $this->session = Mockery::mock(Session::class);
        $this->session->shouldReceive('getDriver')
            ->withNoArgs()
            ->andReturn($driver);
        $this->session->shouldReceive('getSelectorsHandler')
            ->withNoArgs()
            ->andReturn(new SelectorsHandler());
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCreateContextFromSite()
    {
        $context = Context::site('http://localhost', $this->session, 'Example');

        $this->assertInstanceOf(Context::class, $context);
    }

    public function testCreatePageFromContext()
    {
        $context = new Context('http://localhost', $this->session, 'Example');

        $page = $context->createPage('Demo');

        $this->assertInstanceOf(Demo::class, $page);
    }
}
