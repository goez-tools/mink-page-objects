<?php

use Behat\Mink\Driver\CoreDriver;
use Behat\Mink\Element\DocumentElement;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Selector\SelectorsHandler;
use Behat\Mink\Session;
use Example\Articles;
use Example\Demo;
use Example\Navigation;
use Goez\PageObjects\Factory;
use Goez\PageObjects\Page;
use Goez\PageObjects\PageObject;
use Mockery\MockInterface;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MockInterface
     */
    private $session;

    /**
     * @var Factory
     */
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
        $this->factory = new Factory('Example', 'http://localhost');
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCreatePage()
    {
        $page = $this->factory->createPage('Demo', $this->session, 'http://localhost');

        $this->assertInstanceOf(Demo::class, $page);
    }

    public function testCreatePartWithoutSelector()
    {
        $parent = $this->createMockParent();

        $element = $this->factory->createPart('Navigation', $parent, null);

        $this->assertInstanceOf(Navigation::class, $element);
    }

    public function testCreatePartWithSelector()
    {
        $parent = $this->createMockParent();
        $selector = ['css' => '.article'];
        $element = $this->factory->createPart('Articles', $parent, $selector);

        $this->assertInstanceOf(Articles::class, $element);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPageNotFound()
    {
        $this->factory->createPage('NotExists', $this->session, 'http://localhost');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testPartialElementNotFound()
    {
        $this->factory->createPart('NotExists', $this->session);
    }

    /**
     * @return MockInterface
     */
    protected function createMockParent()
    {
        $documentElement = Mockery::mock(DocumentElement::class);
        $documentElement->shouldReceive('find')
            ->withAnyArgs()
            ->andReturn(null);

        $parent = Mockery::mock(PageObject::class);
        $parent->shouldReceive('getSession')
            ->withAnyArgs()
            ->andReturn($this->session);
        $parent->shouldReceive('getElement')
            ->withAnyArgs()
            ->andReturn($documentElement);
        return $parent;
    }
}
