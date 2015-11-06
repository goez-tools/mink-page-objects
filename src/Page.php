<?php

namespace Goez\PageObjects;

use Behat\Mink\Element\DocumentElement;
use Behat\Mink\Session;
use Closure;
use Goez\PageObjects\Exception\ElementNotFoundException;

class Page extends PageObject
{
    protected $baseUrl = 'http://localhost';

    protected $path = '/';

    /**
     * @param $baseUrl
     * @param Session $session
     */
    public function __construct($baseUrl, Session $session)
    {
        $this->setBaseUrl($baseUrl);
        $this->setSession($session);
        $this->initElement();
    }

    /**
     * @param $baseUrl
     * @return Page
     */
    public function setBaseUrl($baseUrl)
    {
        if (filter_var($baseUrl, FILTER_VALIDATE_URL)) {
            $this->baseUrl = rtrim($baseUrl, '/') . '/';
        }
        return $this;
    }

    /**
     *
     */
    protected function initElement()
    {
        $this->element = new DocumentElement($this->session);
    }

    /**
     * @param Closure $callback
     * @return Page
     */
    public function open(Closure $callback = null)
    {
        $this->getSession()->visit($this->getUri());
        if ($callback) {
            $cb = $callback->bindTo($this);
            $cb();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->baseUrl . ltrim($this->path, '/');
    }
}