<?php

namespace Goez\PageObjects;

use Behat\Mink\Session;
use Goez\PageObjects\Element\Page;

class Context
{
    /**
     * @var
     */
    protected $baseUrl;

    /**
     * @var Session
     */
    private $session;

    /**
     * @param $baseUrl
     * @param Session $session
     * @param string $prefix
     * @return Context
     */
    public static function site($baseUrl, Session $session, $prefix = '')
    {
        return new Context($baseUrl, $session, $prefix);
    }

    /**
     * @param string $baseUrl
     * @param Session $session
     * @param string $prefix
     */
    public function __construct($baseUrl, Session $session, $prefix = '')
    {
        $this->baseUrl = $baseUrl;
        $this->factory = $this->createFactory($prefix);
        $this->session = $session;
    }

    /**
     * @param $prefix
     * @return Factory
     */
    public function createFactory($prefix)
    {
        return new Factory($prefix);
    }

    /**
     * @param $name
     * @return Page
     */
    public function createPage($name)
    {
        return $this->factory->createPage($name, $this->session, $this->baseUrl);
    }
}