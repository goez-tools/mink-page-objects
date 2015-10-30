<?php

use Behat\Mink\Driver\CoreDriver;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Selector\SelectorsHandler;
use Behat\Mink\Session;
use Example\Navigation;

class PartialElementTest extends PHPUnit_Framework_TestCase
{
    private $driver;

    private $session;

    public function setUp()
    {
        $this->driver = Mockery::mock(CoreDriver::class);
        $this->driver->shouldReceive('getText')
            ->withAnyArgs()
            ->andReturn('Home');
        $this->driver->shouldReceive('getHtml')
            ->withAnyArgs()
            ->andReturn('<div class="nav"><ul><li><a href="#">Home</a></li></ul>');
        $this->session = Mockery::mock(Session::class);
        $this->session->shouldReceive('getDriver')
            ->withNoArgs()
            ->andReturn($this->driver);
        $this->session->shouldReceive('getSelectorsHandler')
            ->withNoArgs()
            ->andReturn(new SelectorsHandler());
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testGetElementInPartialElementShouldBeANodeElement()
    {
        $element = new Navigation(['css' => '.nav'], $this->session);

        $nodeElement = $element->getElement();

        $this->assertInstanceOf(NodeElement::class, $nodeElement);
    }

    public function testPartialElementShouldContainText()
    {
        $element = new Navigation(['css' => '.nav'], $this->session);

        $element->shouldContainText('Home');
    }

    public function testPartialElementShouldContainHtml()
    {
        $element = new Navigation(['css' => '.nav'], $this->session);

        $element->shouldContainHtml('<a href="#">Home</a>');
    }
}
