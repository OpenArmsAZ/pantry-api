<?php

namespace OpenArms\Pantry\System\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends AbstractController
{
    public function home(Request $request, Response $response): ResponseInterface
    {
        return $response->withJson([
            'message' => 'Joshua 24:15 - But as for me and my household, we will serve the LORD.'
        ]);
    }
}
