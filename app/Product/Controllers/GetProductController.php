<?php
/**
 * Proverbs 18:13 (NIV)
 * To answer before listening — that is folly and shame.
 */

namespace OpenArms\Pantry\Product\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class GetProductController extends AbstractProductController
{
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $product = $this->getProduct($args['product_id']);

        return $response->withJson(
            ['data' => $product],
            201
        );
    }
}
