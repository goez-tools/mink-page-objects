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
     * @param PageObject $parent
     */
    public function __construct($selector, Session $session, PageObject $parent)
    {
        $this->setSelector($selector);
        $this->setSession($session);
        $this->initElement($parent);
    }

    /**
     * @param PageObject $parent
     */
    protected function initElement(PageObject $parent = null)
    {
        list($selectorType, $locator) = $this->getSelectorTypeAndLocator($this->selector);
        if ($parent) {
            $this->parent = $parent;
        }
        $this->element = $this->getParent()->getElement()->find($selectorType, $locator);
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