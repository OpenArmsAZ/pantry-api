<?php

namespace OpenArms\Pantry\System\Controllers;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class AbstractController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
