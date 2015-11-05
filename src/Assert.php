<?php

namespace Goez\PageObjects;

use PHPUnit_Framework_Assert as That;

class Assert implements AssertInterface
{
    /**
     * @var PageObject
     */
    private $pageObject;

    public function __construct(PageObject $element)
    {
        $this->pageObject = $element;
    }

    /**
     * @param $expected
     */
    public function shouldContainText($expected)
    {
        $actual = $this->pageObject->getElement()->getText();

        That::assertContains($expected, $actual);
    }

    /**
     * @param $expected
     */
    public function shouldContainHtml($expected)
    {
        $actual = $this->pageObject->getElement()->getHtml();

        That::assertContains($expected, $actual);
    }

    /**
     * @param $notExpected
     */
    public function shouldNotContainText($notExpected)
    {
        $actual = $this->pageObject->getElement()->getText();

        That::assertNotContains($notExpected, $actual);
    }

    /**
     * @param $notExpected
     */
    public function shouldNotContainHtml($notExpected)
    {
        $actual = $this->pageObject->getElement()->getHtml();

        That::assertNotContains($notExpected, $actual);
    }

    /**
     * @param $pattern
     */
    public function shouldContainPatternInText($pattern)
    {
        $actual = $this->pageObject->getElement()->getText();

        That::assertRegExp($pattern, $actual);
    }

    /**
     * @param $pattern
     */
    public function shouldContainPatternInHtml($pattern)
    {
        $actual = $this->pageObject->getElement()->getHtml();

        That::assertRegExp($pattern, $actual);
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