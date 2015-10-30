<?php

namespace Goez\PageObjects;

use Behat\Mink\Session;

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

    private $defaultConfig = [
        'baseUrl' => 'http://localhost',
        'prefix' => '',
    ];

    /**
     * @param Session $session
     * @param array $config
     * @return Context
     */
    public static function site(Session $session, array $config)
    {
        return new Context($session, $config);
    }

    /**
     * @param Session $session
     * @param array $config
     */
    public function __construct(Session $session, array $config)
    {
        $config = $this->loadConfig($config);
        $this->session = $session;
        $this->baseUrl = $config['baseUrl'];
        $this->factory = $this->createFactory($config['prefix']);
    }

    /**
     * @param array $config
     * @return array
     */
    protected function loadConfig(array $config)
    {
        return array_merge($this->defaultConfig, $config);
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