<?php

namespace Goez\PageObjects;

use Behat\Mink\Session;

class Factory
{
    /**
     * @var string
     */
    protected $prefix = '';

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
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
    public function createPage($name, Session $session, $baseUrl)
    {
        return $this->instantiate($name, Page::class, $session, $baseUrl);
    }

    /**
     * @param $name
     * @param Session $session
     * @param mixed $selector
     * @return mixed
     */
    public function createPartialElement($name, Session $session, $selector = null)
    {
        return $this->instantiate($name, PartialElement::class, $session, $selector);
    }

    /**
     * @param $name
     * @param $baseClass
     * @param Session $session
     * @param $extra
     * @return mixed
     */
    protected function instantiate($name, $baseClass, Session $session, $extra)
    {
        $className = $this->generateClassName($name, $this->prefix);

        if (is_subclass_of($className, $baseClass)) {
            /** @var PageObject $element */
            $element = new $className($extra, $session);
            $element->setFactory($this);
            return $element;
        }

        throw new \InvalidArgumentException(sprintf('Not a page object class: %s', $className));
    }
}
