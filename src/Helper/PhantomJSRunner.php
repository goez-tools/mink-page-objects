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
            $this->printMessage("-");
        } else {
            $this->printMessage("|");
            $this->runPhantomJS();
        }
    }

    /**
     * @return resource
     */
    protected function ifPhantomJsAlreadyRunning()
    {
        set_error_handler(function () {});
        $result = fsockopen("localhost", 4444);
        fclose($result);
        restore_error_handler();
        return !!$result;
    }

    protected function runPhantomJS()
    {
        $cmd = 'phantomjs --webdriver=4444 --ssl-protocol=tlsv1 --ignore-ssl-errors=true';
        shell_exec($cmd . " > /dev/null &");
        sleep(1);
    }

    /**
     * @param $message
     */
    protected function printMessage($message)
    {
        fwrite(STDOUT, "$message");
    }
}