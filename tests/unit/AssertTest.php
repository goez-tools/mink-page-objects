<?php

namespace unit;

use Goez\PageObjects\Assert;
use Goez\PageObjects\PageObject;
use Mockery;

class AssertTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testDelegateToPHPUnitAssert()
    {
        $pageObject = Mockery::mock(PageObject::class);
        $assert = new Assert($pageObject);
        $assert->assertTrue(true);
    }
}
