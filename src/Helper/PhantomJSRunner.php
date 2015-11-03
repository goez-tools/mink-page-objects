<?php

namespace Goez\PageObjects\Helper;

trait PhantomJSRunner
{
    /**
     * @before
     */
    protected function startPhantomJS()
    {
        shell_exec("pkill phantomjs");
        $cmd = 'phantomjs --webdriver=4444 --ssl-protocol=tlsv1 --ignore-ssl-errors=true';
        shell_exec($cmd . " > /dev/null &");
        sleep(1);
    }
}