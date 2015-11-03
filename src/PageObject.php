<?php

namespace Goez\PageObjects;

use Behat\Mink\Element\TraversableElement;
use Behat\Mink\Session;

abstract class PageObject
{
    /**
     * @var PageObject
     */
    protected $parent = null;

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
     * @var Assert
     */
    private $assert;

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        if (preg_match('/^should/', $name)) {
            if (null === $this->assert) {
                $this->assert = new Assert($this);
            }
             return call_user_func_array([$this->assert, $name], $args);
        }
        return false;
    }

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
     * @return PageObject
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * @return PageObject
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param PageObject $parent
     */
    abstract protected function initElement(PageObject $parent = null);

    /**
     * @param $name
     * @return Page
     */
    public function createPage($name)
    {
        return $this->factory->createPage($name, $this->session);
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return TraversableElement
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param $selector
     * @return array
     */
    public function getSelectorTypeAndLocator($selector)
    {
        $selectorType = is_array($selector) ? key($selector) : 'css';
        $locator = is_array($selector) ? $selector[$selectorType] : $selector;
        return [$selectorType, $locator];
    }
}