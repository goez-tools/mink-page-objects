<?php

namespace Google;

use Goez\PageObjects\Page;

class Home extends Page
{
    protected $parts = [
        SearchForm::class => ['css' => 'form'],
    ];

    public function search($keyword)
    {
        return $this->getPart(SearchForm::class)
            ->search($keyword);
    }
}