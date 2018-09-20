<?php
require __DIR__ . "/../vendor/autoload.php";

use Doctrine\Common\DataFixtures\Loader;

$loader = new Loader();
$loader->addFixture(new \OpenArms\Database\Fixtures\FixtureLoader());

$em = \OpenArms\Pantry\Factories\EntityManagerFactory::getInstance();
$purger = new \Doctrine\Common\DataFixtures\Purger\ORMPurger;
$executor = new \Doctrine\Common\DataFixtures\Executor\ORMExecutor($em, $purger);

$executor->execute($loader->getFixtures());