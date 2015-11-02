<?php

namespace Goez\PageObjects;

use Behat\Mink\Element\NodeElement;
use Behat\Mink\Session;

abstract class PartialElement extends PageObject
{
    protected $selector = [];

    /**
     * @param $selector
     * @param Session $session
     */
    public function __construct($selector, Session $session)
    {
        $this->setSelector($selector);
        $this->setSession($session);
        $this->initElement();
    }

    /**
     * @return void
     */
    protected function initElement()
    {
        list($selectorType, $locator) = $this->getSelectorTypeAndLocator($this->selector);
        $this->element = $this->session->getPage()->find($selectorType, $locator);
    }

    /**
     * @param $selector
     */
    private function setSelector($selector)
    {
        if ($selector) {
            $this->selector = $selector;
        }
    }
}