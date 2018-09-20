<?php
/**
 * 1 Corinthians 15:58 ESV
 * Therefore, my beloved brothers, be steadfast, immovable,
 * always abounding in the work of the Lord,
 * knowing that in the Lord your labor is not in vain.
 */

require __DIR__ . '/../vendor/autoload.php';
session_start();

// Instantiate the app
$settings = require __DIR__ . '/../app/settings.php';
$container = new \Slim\Container($settings);

$app = new \Slim\App($container);

// Set up dependencies
require __DIR__ . '/../app/dependencies.php';

// Register middleware
require __DIR__ . '/../app/middleware.php';

// Register routes
require __DIR__ . '/../app/routes.php';

$app->run();
