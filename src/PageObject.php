<?php

namespace Goez\PageObjects;

use Behat\Mink\Element\TraversableElement;
use Behat\Mink\Session;
use PHPUnit_Framework_Assert as Assert;

abstract class PageObject
{
    /**
     * @var Session
     */
    protected $session = null;

    /**
     * @var Factory
     */
    protected $factory = null;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var TraversableElement
     */
    protected $element = null;

    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @param Session $session
     * @return Page
     */
    public function setSession($session)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * @param Factory $factory
     * @return Page
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * @return void
     */
    abstract protected function initElement();

    /**
     * @param $name
     * @return Page
     */
    public function createPage($name)
    {
        return $this->factory->createPage($name, $this->session);
    }

    /**
     * @return TraversableElement
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param $expected
     */
    public function shouldContainText($expected)
    {
        $actual = $this->element->getText();

        Assert::assertContains($expected, $actual);
    }

    /**
     * @param $expected
     */
    public function shouldContainHtml($expected)
    {
        $actual = $this->element->getHtml();

        Assert::assertContains($expected, $actual);
    }

    /**
     * @param $notExpected
     */
    public function shouldNotContainText($notExpected)
    {
        $actual = $this->element->getText();

        Assert::assertNotContains($notExpected, $actual);
    }

    /**
     * @param $notExpected
     */
    public function shouldNotContainHtml($notExpected)
    {
        $actual = $this->element->getHtml();

        Assert::assertNotContains($notExpected, $actual);
    }
}