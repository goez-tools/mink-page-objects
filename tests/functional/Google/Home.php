<?php

namespace Google;

use Goez\PageObjects\Page;

class Home extends Page
{
    protected $elements = [
        'SearchForm' => ['css' => 'form'],
    ];

    public function search($keyword)
    {
        return $this->getPartialElement('SearchForm')
            ->search($keyword);
    }
}