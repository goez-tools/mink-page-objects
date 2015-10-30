<?php
/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->addPsr4('Example\\', __DIR__ . '/unit/Example/');
$loader->addPsr4('Google\\', __DIR__ . '/functional/Google/');
