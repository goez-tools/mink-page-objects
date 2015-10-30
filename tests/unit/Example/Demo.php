<?php

namespace Example;

use Goez\PageObjects\Page;

class Demo extends Page
{
    protected $elements = [
        'Navigation',
        'Articles' => ['xpath' => '//*[contains(@class, "content")]//ul[contains(@class, "articles")]'],
        'Footer' => ['css' => '.footer'],
    ];
}