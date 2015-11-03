<?php

namespace Goez\PageObjects;

use Peridot\Leo\Interfaces\Assert as Assertion;

class Assert
{
    /**
     * @var PageObject
     */
    private $pageObject;

    public function __construct(PageObject $element)
    {
        $this->pageObject = $element;
        $this->assertion = new Assertion;
    }

    /**
     * @param $expected
     */
    public function shouldContainText($expected)
    {
        $actual = $this->pageObject->getElement()->getText();

        $this->assertion->include($actual, $expected);
    }

    /**
     * @param $expected
     */
    public function shouldContainHtml($expected)
    {
        $actual = $this->pageObject->getElement()->getHtml();

        $this->assertion->include($actual, $expected);
    }

    /**
     * @param $notExpected
     */
    public function shouldNotContainText($notExpected)
    {
        $actual = $this->pageObject->getElement()->getText();

        $this->assertion->notInclude($actual, $notExpected);
    }

    /**
     * @param $notExpected
     */
    public function shouldNotContainHtml($notExpected)
    {
        $actual = $this->pageObject->getElement()->getHtml();

        $this->assertion->notInclude($actual, $notExpected);
    }

    /**
     * @param $pattern
     */
    public function shouldContainPatternInText($pattern)
    {
        $actual = $this->pageObject->getElement()->getText();

        $this->assertion->match($actual, $pattern);
    }

    /**
     * @param $pattern
     */
    public function shouldContainPatternInHtml($pattern)
    {
        $actual = $this->pageObject->getElement()->getHtml();

        $this->assertion->match($actual, $pattern);
    }

    /**
     * @param $selector
     * @return bool
     */
    public function shouldFindElement($selector)
    {
        list($selectorType, $locator) = $this->pageObject->getSelectorTypeAndLocator($selector);
        $element = $this->pageObject->getElement()->find($selectorType, $locator);

        return !is_null($element);
    }
}