<?php

use Behat\Mink\Driver\CoreDriver;
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

    public function testCreatePageFromContext()
    {
        $context = new Context($this->session, [
            'baseUrl' => 'http://localhost',
            'prefix' => 'Example',
        ]);

        $page = $context->createPage('Demo');

        $this->assertInstanceOf(Demo::class, $page);
    }
}
