<?php

use Behat\Mink\Driver\CoreDriver;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Selector\SelectorsHandler;
use Behat\Mink\Session;
use Example\Navigation;

class PartialElementTest extends PHPUnit_Framework_TestCase
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

    public function testGetElementInPartialElementShouldBeANodeElement()
    {
        $element = new Navigation(['css' => '.nav'], $this->session);

        $nodeElement = $element->getElement();

        $this->assertInstanceOf(NodeElement::class, $nodeElement);
    }
}
