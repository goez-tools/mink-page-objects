# Implementation of Page Objects Pattern for Mink

Alpha version

## Install

```bash
$ composer require goez/mink-page-objects --dev
```

## Usage

Creating a page object class:

```php
class Home extends Page
{
    // Declare elements in page
    protected $elements = [
        'Navigation',
        'Articles' => ['xpath' => '//*[contains(@class, "content")]//ul[contains(@class, "articles")]'],
        'Footer' => ['css' => '.footer'],
    ];

    public function search($keyword)
    {
        $this->getElement('SearchForm')
            ->search($keyword);
    }
}
```

Creating an element object:

```php
class SearchForm extends Element
{
    /**
     * @var array|string $selector
     */
    protected $selector = '.search-form';

    /**
     * @param string $keyword
     *
     * @return Page
     */
    public function search($keyword)
    {
        $this->fillField('keyword', $keyword);
        $this->pressButton('Search');

        return $this->getPage('SearchResults');
    }
}
```

Instantiating a page object:

```php
$context = Context::site('http://localhost', $session);
$page = $context->createPage('Home');
$page->open();
```

Creating an element object:

```php
$element = $context->createElement('SearchForm');
```

## License

MIT
