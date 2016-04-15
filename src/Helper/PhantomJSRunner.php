<?php

namespace Goez\PageObjects\Helper;

use SebastianBergmann\GlobalState\RuntimeException;

trait PhantomJSRunner
{
    /**
     * @beforeClass
     */
    public static function startPhantomJS()
    {
        self::stopPhantomJS();
        $phantomBin = self::findPhantomJsBin();
        $cmd = $phantomBin . ' --webdriver=4444 --ssl-protocol=tlsv1 --ignore-ssl-errors=true';
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

    /**
     * @return string
     */
    private static function findPhantomJsBin()
    {
        $searchs = [
            trim(shell_exec('echo "`which phantomjs`"')),
            realpath(__DIR__ . '/../../../../../node_modules/phantomjs-prebuilt/bin/phantomjs'),
        ];
        foreach ($searchs as $phantomJsBin) {
            if (file_exists($phantomJsBin)) {
                return $phantomJsBin;
            }
        }
        throw new RuntimeException('PhantomJS is not exists.');
    }
}