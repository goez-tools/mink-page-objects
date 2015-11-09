<?php

namespace Example;

use Goez\PageObjects\Page;

class Demo extends Page
{
    protected $parts = [
        Navigation::class,
        Articles::class => ['xpath' => '//*[contains(@class, "content")]//ul[contains(@class, "articles")]'],
        Footer::class => ['css' => '.footer'],
    ];
}
