<?php

namespace Goez\PageObjects;

use Behat\Mink\Element\TraversableElement;
use Behat\Mink\Session;

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
     * @return TraversableElement
     */
    public function getElement()
    {
        return $this->element;
    }
}