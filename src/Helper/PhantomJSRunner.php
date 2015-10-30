<?php

namespace Goez\PageObjects\Helper;

trait PhantomJSRunner
{
    /**
     * @before
     */
    protected function startPhantomJS()
    {
        if ($this->ifPhantomJsAlreadyRunning()) {
            $this->printMessage("PhantomJS already running");
        } else {
            $this->printMessage("Starting PhantomJS");
            $this->runPhantomJS();
        }
    }

    /**
     * @return resource
     */
    protected function ifPhantomJsAlreadyRunning()
    {
        return fsockopen("localhost", 4444);
    }

    protected function runPhantomJS()
    {
        $cmd = 'phantomjs --webdriver=4444 --ssl-protocol=tlsv1 --ignore-ssl-errors=true';
        shell_exec($cmd . " > /dev/null &");
    }

    /**
     * @param $message
     */
    protected function printMessage($message)
    {
        fwrite(STDOUT, "$message\n");
    }
}