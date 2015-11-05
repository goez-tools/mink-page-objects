<?php
namespace Goez\PageObjects;

/**
 * Interface AssertInterface
 * @package Goez\PageObjects
 */
interface AssertInterface
{
    /**
     * @param $expected
     */
    public function shouldContainText($expected);

    /**
     * @param $expected
     */
    public function shouldContainHtml($expected);

    /**
     * @param $notExpected
     */
    public function shouldNotContainText($notExpected);

    /**
     * @param $notExpected
     */
    public function shouldNotContainHtml($notExpected);

    /**
     * @param $pattern
     */
    public function shouldContainPatternInText($pattern);

    /**
     * @param $pattern
     */
    public function shouldContainPatternInHtml($pattern);

    /**
     * @param $selector
     * @return bool
     */
    public function shouldFindElement($selector);
}