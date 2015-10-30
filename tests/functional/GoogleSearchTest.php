<?php

use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Session;
use Goez\PageObjects\Context;
use Google\Home;

class GoogleSearchTest extends PHPUnit_Framework_TestCase
{
    public function testSearchWithKeyword()
    {
        // 使用 PhantomJS 當做 Driver
        $driver = new Selenium2Driver('phantomjs');

        // 建立一個 Session 物件來控制瀏覧器
        $session = new Session($driver);
        $session->start();

        $context = Context::site($session, [
            'baseUrl' => 'https://www.google.com',
            'prefix' => 'Google',
        ]);

        // 瀏覽 Google 首頁
        /** @var Home $homePage */
        $homePage = $context->createPage('Home');
        $homePage->open();

        $homePage->search('Jace Ju')
            ->shouldContainText('網站製作學習誌');
    }
}
