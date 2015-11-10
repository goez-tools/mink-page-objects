<?php

namespace Goez\PageObjects;

use BadMethodCallException;
use Behat\Mink\Element\TraversableElement;
use Behat\Mink\Session;
use DOMElement;
use Goez\PageObjects\Exception\ElementNotFoundException;
use PHPUnit_Framework_Constraint;

/**
 * Class PageObject
 * @package Goez\PageObjects
 *
 * @method shouldContainText($expected)
 * @method shouldContainHtml($expected)
 * @method shouldNotContainText($notExpected)
 * @method shouldNotContainHtml($notExpected)
 * @method shouldContainPatternInText($pattern)
 * @method shouldContainPatternInHtml($pattern)
 * @method shouldFindElement($selector)
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
abstract class PageObject
{
    /**
     * @var PageObject
     */
    protected $parent = null;

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
     * Parts of Page or Part
     *
     * @var array
     */
    protected $parts = [];

    /**
     * @var Assert
     */
    private $assert;

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     * @throw BadMethodCallException
     */
    public function __call($name, $args)
    {
        if (preg_match('/^(should|assert)/', $name)) {
            if (null === $this->assert) {
                $this->assert = new Assert($this);
            }
            return call_user_func_array([$this->assert, $name], $args);
        }
        throw new BadMethodCallException;
    }

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
     * @return PageObject
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * @return PageObject
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param $name
     * @return Page
     */
    public function createPage($name)
    {
        return $this->factory->createPage($name, $this->session);
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return TraversableElement
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param $selector
     * @return array
     */
    public function getSelectorTypeAndLocator($selector)
    {
        $selectorType = is_array($selector) ? key($selector) : 'css';
        $locator = is_array($selector) ? $selector[$selectorType] : $selector;
        return [$selectorType, $locator];
    }

    /**
     * @param $name
     * @return PageObject
     * @throws ElementNotFoundException
     */
    public function getPart($name)
    {
        if (in_array($name, $this->parts)) {
            return $this->factory->createPart($name, $this);
        } elseif (isset($this->parts[$name])) {
            $selector = $this->parts[$name];
            return $this->factory->createPart($name, $this, $selector);
        }

        throw new ElementNotFoundException(sprintf('Can\'t find the element: %s', $name));
    }

    /**
     * @param $name
     * @return PageObject
     * @deprecated
     */
    public function getPartialElement($name)
    {
        return $this->getPart($name);
    }

    /**
     * @param $title
     */
    public function seeTitle($title)
    {
        $this->shouldContainPatternInHtml('/<title[^>]*>\s*' . $title . '\s*<\/title>/');
    }

    /**
     * @param $heading
     */
    public function seeHeading($heading)
    {
        $this->shouldContainPatternInHtml('/<h1[^>]*>\s*' . $heading . '\s*<\/h1>/');
    }

    /**
     * @param $heading
     */
    public function seeSubHeading($heading)
    {
        $this->shouldContainPatternInHtml('/<h2[^>]*>\s*' . $heading . '\s*<\/h2>/');
    }
}