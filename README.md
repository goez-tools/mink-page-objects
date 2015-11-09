# Page Objects Pattern for Mink

[![Build Status](https://travis-ci.org/jaceju/mink-page-objects.svg?branch=master)](https://travis-ci.org/jaceju/mink-page-objects)

Alpha version

## Install

```bash
$ composer require goez/mink-page-objects --dev
```

## Usage

Creating a page class for Google homepage:

```php
use Goez\PageObjects\Page;

class Home extends Page
{
    protected $elements = [
        'SearchForm' => ['css' => 'form'],
    ];

    public function search($keyword)
    {
        return $this->getPart(SearchForm::class)
            ->search($keyword);
    }
}
```

Create a page class for searched result:

```php
use Goez\PageObjects\Page;

class SearchResult extends Page
{
}
```

Creating an element object for searching form:

```php
use Goez\PageObjects\Part;

class SearchForm extends Part
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

        return $this->createPage(SearchResult::class);
    }
}
```

Instantiating a page object and verify keyword searching:

```php
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Session;
use Goez\PageObjects\Context;

class GoogleSearchTest extends PHPUnit_Framework_TestCase
{
    // Install phantomjs first
    // and you can use this trait
    // for starting phantonjs automatically
    use PhantomJSRunner;

    public function testSearchWithKeyword()
    {
        $driver = new Selenium2Driver('phantomjs');

        $session = new Session($driver);
        $session->start();

        $context = new Context($session, [
            'baseUrl' => 'https://www.google.com',
        ]);

        $context->createPage(Home::class)
            ->open()
            ->search('example')
            ->shouldContainText('Example Domain');
    }
}
```

## License

MIT
