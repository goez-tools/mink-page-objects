<?php

namespace Google;

use Goez\PageObjects\Part;

class SearchForm extends Part
{
    /**
     * @param $keyword
     * @return SearchResult
     * @throws \Goez\PageObjects\Exception\ElementNotFoundException
     */
    public function search($keyword)
    {
        $this->element->fillField('q', $keyword);
        $this->element->submit();

        return $this->createPage(SearchResult::class);
    }
}