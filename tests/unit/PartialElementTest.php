<?php

use Behat\Mink\Driver\CoreDriver;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Selector\SelectorsHandler;
use Behat\Mink\Session;
use Example\Demo;
use Example\Navigation;

class PartialElementTest extends PHPUnit_Framework_TestCase
{
    private $driver;

    private $session;

    private $parent;

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
        $this->parent->shouldReceive('getElement->find')
            ->withAnyArgs()
            ->andReturn(new NodeElement('', $this->session));
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testGetElementInPartialElementShouldBeANodeElement()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);

        $nodeElement = $element->getElement();

        $this->assertInstanceOf(NodeElement::class, $nodeElement);
    }

    public function testPartialElementShouldContainText()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);

        $element->shouldContainText('Home');
    }

    public function testPartialElementShouldContainHtml()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);

        $element->shouldContainHtml('<a href="#">Home</a>');
    }

    public function testPartialElementShouldNotContainText()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);

        $element->shouldNotContainText('Who are you?');
    }

    public function testPartialElementShouldNotContainHtml()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);

        $element->shouldNotContainHtml('<a href="#">Who are you?</a>');
    }

    public function testPartialElementShouldContainPatternInText()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);

        $element->shouldContainPatternInText('/Ho.+/');
    }


    public function testPartialElementShouldContainPatternInHtml()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);

        $element->shouldContainPatternInHtml('/<a[^>]+>[^<]+<\/a>/');
    }

    public function testPartialElementShouldFindElement()
    {
        $element = new Navigation(['css' => '.nav'], $this->session, $this->parent);
        $this->driver->shouldReceive('find')
            ->withAnyArgs()
            ->andReturn(new NodeElement("//*[@id='home-link']", $this->session));
        $element->shouldFindElement(['css' => '#home-link']);
    }
}
