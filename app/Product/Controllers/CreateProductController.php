<?php
/**
 * Proverbs 18:13 (NIV)
 * To answer before listening — that is folly and shame.
 */

namespace OpenArms\Pantry\Product\Controllers;

use OpenArms\Pantry\Entities\InventoryLevel;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateProductController extends AbstractProductController
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $input = $request->getParsedBody() ?? [];
        $input['inventory_level'] = new InventoryLevel();
        $this->saveArrayProduct($input);

        return $response->withStatus(201);
    }
}
