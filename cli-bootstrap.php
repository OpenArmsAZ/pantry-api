<?php
/**
 * Basic bootstrap for CLI scripts.
 */
require __DIR__ . "/vendor/autoload.php";

define('ROOT', __DIR__);

use Slim\Container;
$settings = require __DIR__ . '/app/settings.php';
$container = new Container($settings);
require __DIR__ . '/app/dependencies.php';