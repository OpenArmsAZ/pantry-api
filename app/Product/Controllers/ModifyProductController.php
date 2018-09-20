<?php

namespace OpenArms\Pantry\Product\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class ModifyProductController extends AbstractProductController
{
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $product = $this->getProduct($args['product_id']);
        $input = $request->getParsedBody() ?? [];
        $product->hydrate($input);
        $this->saveProduct($product);

        return $response->withStatus(204);
    }
}
