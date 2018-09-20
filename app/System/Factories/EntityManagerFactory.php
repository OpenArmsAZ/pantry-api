<?php

namespace OpenArms\Pantry\System\Factories;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\EventManager;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Gedmo\DoctrineExtensions;
use Gedmo\Timestampable\TimestampableListener;

class EntityManagerFactory
{
    /**
     * @var EntityManager
     */
    private static $em;

    public static function getInstance()
    {
        if (self::$em == null) {
            $dbConfig = [
                'driver' => 'pdo_mysql',
                'host' => getenv('MYSQL_HOST'),
                'user' => getenv('MYSQL_USERNAME'),
                'password' => getenv('MYSQL_PASSWORD'),
                'dbname' => getenv('MYSQL_DATABASE'),
                'charset' => 'utf8'
            ];
            $paths = [__DIR__ . "/../../Entities"];
            $isDevMode = false;

            $cache = new ArrayCache;
            $annotationReader = new AnnotationReader;
            /** @var AnnotationReader $cachedAnnotationReader */
            $cachedAnnotationReader = new CachedReader(
                $annotationReader, // use reader
                $cache // and a cache driver
            );

            $driverChain = new MappingDriverChain();

            $config = Setup::createConfiguration($isDevMode);

            DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
                $driverChain, // our metadata driver chain, to hook into
                $cachedAnnotationReader // our cached annotation reader
            );

            $driver = new AnnotationDriver($cachedAnnotationReader, $paths);
            $evm = new EventManager();

            // timestampable
            $timestampableListener = new TimestampableListener();
            $timestampableListener->setAnnotationReader($cachedAnnotationReader);
            $evm->addEventSubscriber($timestampableListener);

            AnnotationRegistry::registerLoader('class_exists');
            $config->setMetadataDriverImpl($driver);
            $config->setMetadataCacheImpl($cache);
            $config->setQueryCacheImpl($cache);
            self::$em = EntityManager::create($dbConfig, $config, $evm);

            $config = self::$em->getConfiguration();
            $config->addCustomStringFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
            $config->addCustomStringFunction('DATE_FORMAT', 'DoctrineExtensions\Query\Mysql\DateFormat');
            $config->addCustomStringFunction('HOUR', 'DoctrineExtensions\Query\Mysql\HOUR');
            $config->addCustomStringFunction('ROUND', 'DoctrineExtensions\Query\Mysql\ROUND');
        }

        return self::$em;
    }
}
