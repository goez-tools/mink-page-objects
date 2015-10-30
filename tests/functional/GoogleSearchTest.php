<?php

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Session;
use Goez\PageObjects\Context;
use Goez\PageObjects\Helper\PhantomJSRunner;

class GoogleSearchTest extends PHPUnit_Framework_TestCase
{
    use PhantomJSRunner;

    /**
     *
     */
    public function testSearchWithKeyword()
    {
        $driver = new Selenium2Driver('phantomjs');

        $session = new Session($driver);
        $session->start();

        $context = new Context($session, [
            'baseUrl' => 'https://www.google.com',
            'prefix' => 'Google',
        ]);

        $context->createPage('Home')
            ->open()
            ->search('Jace Ju')
            ->shouldContainText('網站製作學習誌');
    }
}
