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
        if (class_exists($name)) {
            return $name;
        }

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
        return $this->instantiate($name, $session, $baseUrl);
    }

    /**
     * @param $name
     * @param mixed $selector
     * @param PageObject $parent
     * @return mixed
     */
    public function createPart($name, $parent = null, $selector = null)
    {
        return $this->instantiate($name, $parent, $selector);
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
        return $this->createPart($name, $parent, $selector);
    }


    /**
     * @param $name
     * @param $extra
     * @param PageObject|Session $parent
     * @return mixed
     */
    protected function instantiate($name, $parent, $extra)
    {
        $className = $this->generateClassName($name, $this->prefix);

        /** @var PageObject $pageObject */
        if (is_subclass_of($className, PageObject::class)) {
            $pageObject = new $className($extra, $parent);
            $pageObject->setFactory($this);
            return $pageObject;
        }

        throw new \InvalidArgumentException(sprintf('Not a page object class: %s', $className));
    }
}
