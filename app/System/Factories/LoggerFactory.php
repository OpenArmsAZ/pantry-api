<?php
namespace OpenArms\Pantry\System\Factories;

use FluentHandler\FluentHandler;
use Monolog\Logger;

class LoggerFactory
{
    /**
     * @var Logger
     */
    private static $logger;

    public static function getInstance()
    {
        if (self::$logger === null) {
            $logger = new Logger('Skeleton');
            $logger->pushHandler(new FluentHandler(
                null,
                getenv('LOG_HOST'),
                getenv('LOG_PORT')
            ));
            self::$logger = $logger;
        }

        return self::$logger;
    }
}
