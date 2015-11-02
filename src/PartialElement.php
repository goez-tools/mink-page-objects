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
        $this->element = new NodeElement($this->getSelectorAsXpath(), $this->session);
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

    private function getSelectorAsXpath()
    {
        list($selectorType, $locator) = $this->getSelectorTypeAndLocator($this->selector);
        $selectorsHandler = $this->session->getSelectorsHandler();
        return $selectorsHandler->selectorToXpath($selectorType, $locator);
    }
}