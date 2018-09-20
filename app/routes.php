<?php
/**
 * Application HTTP Routes
 *
 * @var Slim\App $app
 */

/**
 * Romans 8:18 (NIV)
 * I consider that our present sufferings are not worth comparing
 * with the glory that will be revealed in us.
 */

$app->get(
    '/',
    \OpenArms\Pantry\System\Controllers\HomeController::class . ":home"
);

use OpenArms\Pantry\Product\Controllers;
use OpenArms\Pantry\Product\Middleware;

$app->group('/product', function () {
    $this
        ->post('', Controllers\CreateProductController::class)
        ->add(Middleware\CreateProductValidation::class);

    $this
        ->get('/{product_id}', Controllers\GetProductController::class);

    $this
        ->patch('/{product_id}', Controllers\ModifyProductController::class)
        ->add(Middleware\ModifyProductValidation::class);
});

$app->group('/donation',function(){
    $this->post('',\OpenArms\Pantry\Donation\Controllers\CreateDonationController::class);
});

$app->post("/token", \OpenArms\Pantry\Authentication\Controllers\CreateToken::class);
