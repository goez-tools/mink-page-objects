<?php

namespace Goez\PageObjects;

use DOMElement;
use PHPUnit_Framework_Assert as That;
use PHPUnit_Framework_Constraint;

/**
 * @method assertArrayHasKey($key, $array, $message = '')
 * @method assertArraySubset($subset, $array, $strict = false, $message = '')
 * @method assertArrayNotHasKey($key, $array, $message = '')
 * @method assertContains($needle, $haystack, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
 * @method assertAttributeContains($needle, $haystackAttributeName, $haystackClassOrObject, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
 * @method assertNotContains($needle, $haystack, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
 * @method assertAttributeNotContains($needle, $haystackAttributeName, $haystackClassOrObject, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
 * @method assertContainsOnly($type, $haystack, $isNativeType = null, $message = '')
 * @method assertContainsOnlyInstancesOf($classname, $haystack, $message = '')
 * @method assertAttributeContainsOnly($type, $haystackAttributeName, $haystackClassOrObject, $isNativeType = null, $message = '')
 * @method assertNotContainsOnly($type, $haystack, $isNativeType = null, $message = '')
 * @method assertAttributeNotContainsOnly($type, $haystackAttributeName, $haystackClassOrObject, $isNativeType = null, $message = '')
 * @method assertCount($expectedCount, $haystack, $message = '')
 * @method assertAttributeCount($expectedCount, $haystackAttributeName, $haystackClassOrObject, $message = '')
 * @method assertNotCount($expectedCount, $haystack, $message = '')
 * @method assertAttributeNotCount($expectedCount, $haystackAttributeName, $haystackClassOrObject, $message = '')
 * @method assertEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
 * @method assertAttributeEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
 * @method assertNotEquals($expected, $actual, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
 * @method assertAttributeNotEquals($expected, $actualAttributeName, $actualClassOrObject, $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
 * @method assertEmpty($actual, $message = '')
 * @method assertAttributeEmpty($haystackAttributeName, $haystackClassOrObject, $message = '')
 * @method assertNotEmpty($actual, $message = '')
 * @method assertAttributeNotEmpty($haystackAttributeName, $haystackClassOrObject, $message = '')
 * @method assertGreaterThan($expected, $actual, $message = '')
 * @method assertAttributeGreaterThan($expected, $actualAttributeName, $actualClassOrObject, $message = '')
 * @method assertGreaterThanOrEqual($expected, $actual, $message = '')
 * @method assertAttributeGreaterThanOrEqual($expected, $actualAttributeName, $actualClassOrObject, $message = '')
 * @method assertLessThan($expected, $actual, $message = '')
 * @method assertAttributeLessThan($expected, $actualAttributeName, $actualClassOrObject, $message = '')
 * @method assertLessThanOrEqual($expected, $actual, $message = '')
 * @method assertAttributeLessThanOrEqual($expected, $actualAttributeName, $actualClassOrObject, $message = '')
 * @method assertFileEquals($expected, $actual, $message = '', $canonicalize = false, $ignoreCase = false)
 * @method assertFileNotEquals($expected, $actual, $message = '', $canonicalize = false, $ignoreCase = false)
 * @method assertStringEqualsFile($expectedFile, $actualString, $message = '', $canonicalize = false, $ignoreCase = false)
 * @method assertStringNotEqualsFile($expectedFile, $actualString, $message = '', $canonicalize = false, $ignoreCase = false)
 * @method assertFileExists($filename, $message = '')
 * @method assertFileNotExists($filename, $message = '')
 * @method assertTrue($condition, $message = '')
 * @method assertNotTrue($condition, $message = '')
 * @method assertFalse($condition, $message = '')
 * @method assertNotFalse($condition, $message = '')
 * @method assertNotNull($actual, $message = '')
 * @method assertNull($actual, $message = '')
 * @method assertClassHasAttribute($attributeName, $className, $message = '')
 * @method assertClassNotHasAttribute($attributeName, $className, $message = '')
 * @method assertClassHasStaticAttribute($attributeName, $className, $message = '')
 * @method assertClassNotHasStaticAttribute($attributeName, $className, $message = '')
 * @method assertObjectHasAttribute($attributeName, $object, $message = '')
 * @method assertObjectNotHasAttribute($attributeName, $object, $message = '')
 * @method assertSame($expected, $actual, $message = '')
 * @method assertAttributeSame($expected, $actualAttributeName, $actualClassOrObject, $message = '')
 * @method assertNotSame($expected, $actual, $message = '')
 * @method assertAttributeNotSame($expected, $actualAttributeName, $actualClassOrObject, $message = '')
 * @method assertInstanceOf($expected, $actual, $message = '')
 * @method assertAttributeInstanceOf($expected, $attributeName, $classOrObject, $message = '')
 * @method assertNotInstanceOf($expected, $actual, $message = '')
 * @method assertAttributeNotInstanceOf($expected, $attributeName, $classOrObject, $message = '')
 * @method assertInternalType($expected, $actual, $message = '')
 * @method assertAttributeInternalType($expected, $attributeName, $classOrObject, $message = '')
 * @method assertNotInternalType($expected, $actual, $message = '')
 * @method assertAttributeNotInternalType($expected, $attributeName, $classOrObject, $message = '')
 * @method assertRegExp($pattern, $string, $message = '')
 * @method assertNotRegExp($pattern, $string, $message = '')
 * @method assertSameSize($expected, $actual, $message = '')
 * @method assertNotSameSize($expected, $actual, $message = '')
 * @method assertStringMatchesFormat($format, $string, $message = '')
 * @method assertStringNotMatchesFormat($format, $string, $message = '')
 * @method assertStringMatchesFormatFile($formatFile, $string, $message = '')
 * @method assertStringNotMatchesFormatFile($formatFile, $string, $message = '')
 * @method assertStringStartsWith($prefix, $string, $message = '')
 * @method assertStringStartsNotWith($prefix, $string, $message = '')
 * @method assertStringEndsWith($suffix, $string, $message = '')
 * @method assertStringEndsNotWith($suffix, $string, $message = '')
 * @method assertXmlFileEqualsXmlFile($expectedFile, $actualFile, $message = '')
 * @method assertXmlFileNotEqualsXmlFile($expectedFile, $actualFile, $message = '')
 * @method assertXmlStringEqualsXmlFile($expectedFile, $actualXml, $message = '')
 * @method assertXmlStringNotEqualsXmlFile($expectedFile, $actualXml, $message = '')
 * @method assertXmlStringEqualsXmlString($expectedXml, $actualXml, $message = '')
 * @method assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, $message = '')
 * @method assertEqualXMLStructure(DOMElement $expectedElement, DOMElement $actualElement, $checkAttributes = false, $message = '')
 * @method assertSelectCount($selector, $count, $actual, $message = '', $isHtml = true)
 * @method assertSelectRegExp($selector, $pattern, $count, $actual, $message = '', $isHtml = true)
 * @method assertSelectEquals($selector, $content, $count, $actual, $message = '', $isHtml = true)
 * @method assertTag($matcher, $actual, $message = '', $isHtml = true)
 * @method assertNotTag($matcher, $actual, $message = '', $isHtml = true)
 * @method assertThat($value, PHPUnit_Framework_Constraint $constraint, $message = '')
 * @method assertJson($actualJson, $message = '')
 * @method assertJsonStringEqualsJsonString($expectedJson, $actualJson, $message = '')
 * @method assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, $message = '')
 * @method assertJsonStringEqualsJsonFile($expectedFile, $actualJson, $message = '')
 * @method assertJsonStringNotEqualsJsonFile($expectedFile, $actualJson, $message = '')
 * @method assertJsonFileNotEqualsJsonFile($expectedFile, $actualFile, $message = '')
 * @method assertJsonFileEqualsJsonFile($expectedFile, $actualFile, $message = '')
 */
class Assert implements AssertInterface
{
    /**
     * @var PageObject
     */
    private $pageObject;

    /**
     * Assert constructor.
     * @param PageObject $element
     */
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

    /**
     * @param $name
     * @param $args
     */
    public function __call($name, $args)
    {
        $callback = [That::class, $name];
        if (preg_match('/^assert/i', $name)) {
            call_user_func_array($callback, $args);
        }
    }
}