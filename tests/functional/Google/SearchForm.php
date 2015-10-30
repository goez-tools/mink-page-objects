<?php

namespace Google;

use Goez\PageObjects\PartialElement;

class SearchForm extends PartialElement
{
    /**
     * @param $keyword
     * @return SearchResult
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function search($keyword)
    {
        $this->element->fillField('q', $keyword);
        $this->element->submit();

        return $this->createPage('SearchResult');
    }
}