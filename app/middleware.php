<?php
/**
 * Middleware
 *
 * @var \Slim\App $app
 * @var \Psr\Container\ContainerInterface $container
 */

/**
 * Jeremiah 29:11 (NIV)
 * For I know the plans I have for you,
 * plans to prosper you and not to harm you,
 * plans to give you hope and a future.
 */

$container["token"] = function ($container) {
    return new \OpenArms\Pantry\Services\Authentication\Token();
};

$container["JwtAuthentication"] = function ($container) {
    return new \Tuupola\Middleware\JwtAuthentication([
        "path" => "/",
        "ignore" => ["/token"],
        "secret" => getenv("JWT_SECRET"),
        "logger" => $container["logger"],
        "attribute" => false,
        "relaxed" => ["127.0.0.1", "localhost"],
        "error" => function (\Slim\Http\Response $response, array $arguments) {
            return $response->withJson(
                ['message' => $arguments["message"]],
                401
            );
        },
        "before" => function ($request, $arguments) use ($container) {
            $container["token"]->populate($arguments["decoded"]);
        }
    ]);
};
