<?php

namespace Goez\PageObjects;

use Behat\Mink\Element\NodeElement;
use Behat\Mink\Session;

/**
 * Class Part
 * @package Goez\PageObjects
 */
abstract class Part extends PageObject
{
    protected $selector = [];

    /**
     * @param $selector
     * @param PageObject $parent
     */
    public function __construct($selector, PageObject $parent)
    {
        $this->setSelector($selector);
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

        $this->setSession($this->getParent()->getSession());
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