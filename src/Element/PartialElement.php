<?php

namespace Goez\PageObjects\Element;

use Behat\Mink\Element\NodeElement;
use Behat\Mink\Session;
use Goez\PageObjects\PageObject;

abstract class PartialElement extends PageObject
{
    protected $selector = null;

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
        $selectorsHandler = $this->session->getSelectorsHandler();
        $selectorType = is_array($this->selector) ? key($this->selector) : 'css';
        $locator = is_array($this->selector) ? $this->selector[$selectorType] : $this->selector;

        return $selectorsHandler->selectorToXpath($selectorType, $locator);
    }
}