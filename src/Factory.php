<?php

namespace Goez\PageObjects;

use Behat\Mink\Session;

class Factory
{
    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @var string
     */
    private $baseUrl = 'http://localhost';

    /**
     * @param $prefix
     * @param $baseUrl
     */
    public function __construct($prefix, $baseUrl)
    {
        $this->prefix = $prefix;
        $this->baseUrl = $baseUrl;
    }

    /**
     * @param $name
     * @param $prefix
     * @return string
     */
    protected function generateClassName($name, $prefix)
    {
        if (is_string($prefix)) {
            $this->prefix = $prefix;
        }

        return $this->prefix . "\\$name";
    }

    /**
     * @param string $name
     * @param Session $session
     * @param $baseUrl
     * @return Page
     */
    public function createPage($name, Session $session, $baseUrl = '')
    {
        if (empty($baseUrl)) {
            $baseUrl = $this->baseUrl;
        }
        return $this->instantiate($name, Page::class, $session, $baseUrl);
    }

    /**
     * @param $name
     * @param Session $session
     * @param mixed $selector
     * @param PageObject $parent
     * @return mixed
     */
    public function createPart($name, Session $session, $selector = null, $parent = null)
    {
        return $this->instantiate($name, Part::class, $session, $selector, $parent);
    }

    /**
     * @param $name
     * @param Session $session
     * @param mixed $selector
     * @param PageObject $parent
     * @return mixed
     * @deprecated
     */
    public function createPartialElement($name, Session $session, $selector = null, $parent = null)
    {
        return $this->createPart($name, $session, $selector, $parent);
    }


    /**
     * @param $name
     * @param $baseClass
     * @param Session $session
     * @param $extra
     * @param PageObject $parent
     * @return mixed
     */
    protected function instantiate($name, $baseClass, Session $session, $extra, PageObject $parent = null)
    {
        $className = $this->generateClassName($name, $this->prefix);

        if (is_subclass_of($className, $baseClass)) {
            /** @var PageObject $element */
            $element = new $className($extra, $session, $parent);
            $element->setFactory($this);
            return $element;
        }

        throw new \InvalidArgumentException(sprintf('Not a page object class: %s', $className));
    }
}
