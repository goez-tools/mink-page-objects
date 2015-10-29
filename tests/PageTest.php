<?php

use Behat\Mink\Driver\CoreDriver;
use Behat\Mink\Selector\SelectorsHandler;
use Behat\Mink\Session;
use Example\Demo;
use Example\Navigation;
use Goez\PageObjects\Factory;

class PageTest extends PHPUnit_Framework_TestCase
{
    private $session;

    private $factory;

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
        $this->factory = new Factory('Example');
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testOpen()
    {
        $page = new Demo('http://localhost', $this->session);
        $this->session->shouldReceive('visit')
            ->once()
            ->andReturnNull();

        $page->open();
        $uri = $page->getUri();

        $this->assertEquals('http://localhost/', $uri);
    }

    public function testGetElementWithoutSelectorFromPage()
    {
        $page = new Demo('http://localhost', $this->session);
        $page->setFactory($this->factory);

        $element = $page->getElement('Navigation');

        $this->assertInstanceOf(Navigation::class, $element);
    }
}
