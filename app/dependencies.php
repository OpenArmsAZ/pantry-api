<?php
/**
 * Core Application Dependencies
 */

$container['EntityManager'] = function () {
    return \OpenArms\Pantry\System\Factories\EntityManagerFactory::getInstance();
};

$container["logger"] = function ($container) {
    $logger = new \Monolog\Logger("slim");

    $formatter = new \Monolog\Formatter\LineFormatter(
        "[%datetime%] [%level_name%]: %message% %context%\n",
        null,
        true,
        true
    );

    /* Log to timestamped files */
    $rotating = new \Monolog\Handler\RotatingFileHandler(
        __DIR__ . "/../logs/slim.log",
        0,
        \Monolog\Logger::DEBUG
    );
    $rotating->setFormatter($formatter);
    $logger->pushHandler($rotating);

    return $logger;
};
