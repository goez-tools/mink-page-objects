<?php

namespace Goez\PageObjects;

use BadMethodCallException;
use Behat\Mink\Element\TraversableElement;
use Behat\Mink\Session;
use Goez\PageObjects\Exception\ElementNotFoundException;

/**
 * Class PageObject
 * @package Goez\PageObjects
 *
 * @method shouldContainText($expected)
 * @method shouldContainHtml($expected)
 * @method shouldNotContainText($notExpected)
 * @method shouldNotContainHtml($notExpected)
 * @method shouldContainPatternInText($pattern)
 * @method shouldContainPatternInHtml($pattern)
 * @method shouldFindElement($selector)
 */
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
     * @throw BadMethodCallException
     */
    public function __call($name, $args)
    {
        if (preg_match('/^should/', $name)) {
            if (null === $this->assert) {
                $this->assert = new Assert($this);
            }
             return call_user_func_array([$this->assert, $name], $args);
        }
        throw new BadMethodCallException;
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

    /**
     * @param $name
     * @return PageObject
     * @throws ElementNotFoundException
     */
    public function getPartialElement($name)
    {
        if (in_array($name, $this->elements)) {
            return $this->factory->createPartialElement($name, $this->session, null, $this);
        } elseif (isset($this->elements[$name])) {
            $selector = $this->elements[$name];
            return $this->factory->createPartialElement($name, $this->session, $selector, $this);
        }

        throw new ElementNotFoundException();
    }
}