<?php

use Behat\Mink\Driver\CoreDriver;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Selector\SelectorsHandler;
use Behat\Mink\Session;
use Example\Demo;
use Example\Navigation;
use Goez\PageObjects\Part;

class PartTest extends PHPUnit_Framework_TestCase
{
    private $driver;

    private $session;

    private $parent;

    /**
     * @var Part
     */
    private $part;

    public function setUp()
    {
        $html = '<div class="nav"><ul><li id="home-link"><a href="#">Home</a></li></ul>';
        $text = strip_tags($html);
        $this->driver = Mockery::mock(CoreDriver::class);
        $this->driver->shouldReceive('getText')
            ->withAnyArgs()
            ->andReturn($text);
        $this->driver->shouldReceive('getHtml')
            ->withAnyArgs()
            ->andReturn($html);
        $this->session = Mockery::mock(Session::class);
        $this->session->shouldReceive('getDriver')
            ->withNoArgs()
            ->andReturn($this->driver);
        $this->session->shouldReceive('getSelectorsHandler')
            ->withNoArgs()
            ->andReturn(new SelectorsHandler());
        $this->parent = Mockery::mock(Demo::class);
        $this->parent->shouldReceive('getSession')
            ->withAnyArgs()
            ->andReturn($this->session);
        $this->parent->shouldReceive('getElement->find')
            ->withAnyArgs()
            ->andReturn(new NodeElement('', $this->session));
        $this->part = new Navigation(['css' => '.nav'], $this->parent);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testGetElementInPartShouldBeANodeElement()
    {
        $nodeElement = $this->part->getElement();

        $this->assertInstanceOf(NodeElement::class, $nodeElement);
    }

    public function testPartShouldContainText()
    {
        $this->part->shouldContainText('Home');
    }

    public function testPartShouldContainHtml()
    {
        $this->part->shouldContainHtml('<a href="#">Home</a>');
    }

    public function testPartShouldNotContainText()
    {
        $this->part->shouldNotContainText('Who are you?');
    }

    public function testPartShouldNotContainHtml()
    {
        $this->part->shouldNotContainHtml('<a href="#">Who are you?</a>');
    }

    public function testPartShouldContainPatternInText()
    {
        $this->part->shouldContainPatternInText('/Ho.+/');
    }

    public function testPartShouldContainPatternInHtml()
    {
        $this->part->shouldContainPatternInHtml('/<a[^>]+>[^<]+<\/a>/');
    }

    public function testPartShouldFindElement()
    {
        $this->driver->shouldReceive('find')
            ->withAnyArgs()
            ->andReturn(new NodeElement("//*[@id='home-link']", $this->session));
        $this->part->shouldFindElement(['css' => '#home-link']);
    }
}
