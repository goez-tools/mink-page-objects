<?php

namespace Goez\PageObjects\Helper;

trait PhantomJSRunner
{
    /**
     * @beforeClass
     */
    public static function startPhantomJS()
    {
        shell_exec("pkill phantomjs");
        $cmd = 'phantomjs --webdriver=4444 --ssl-protocol=tlsv1 --ignore-ssl-errors=true';
        shell_exec($cmd . " > /dev/null &");
        sleep(1);
    }

    /**
     * @afterClass
     */
    public static function stopPhantomJS()
    {
        shell_exec("pkill phantomjs");
    }
}