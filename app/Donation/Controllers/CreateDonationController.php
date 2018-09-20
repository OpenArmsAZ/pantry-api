<?php

namespace OpenArms\Pantry\Donation\Controllers;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateDonationController extends AbstractDonationController
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $input = $request->getParsedBody() ?? [];

        $this->saveArrayDonation($input);

        return $response->withStatus(204);
    }
}
