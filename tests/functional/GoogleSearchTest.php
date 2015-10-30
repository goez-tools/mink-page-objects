<?php

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Session;
use Goez\PageObjects\Context;
use Helper\PhantomJSRunner;
use Google\Home;

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

        $context = Context::site($session, [
            'baseUrl' => 'https://www.google.com',
            'prefix' => 'Google',
        ]);

        /** @var Home $homePage */
        $homePage = $context->createPage('Home');
        $homePage->open();

        $homePage->search('Jace Ju')
            ->shouldContainText('網站製作學習誌');
    }
}
