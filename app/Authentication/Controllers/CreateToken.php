<?php

namespace OpenArms\Pantry\Authentication\Controllers;

use Firebase\JWT\JWT;
use OpenArms\Pantry\System\Controllers\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateToken extends AbstractController
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        $now = new \DateTime();
        $future = new \DateTime("now +2 hours");
        $server = $request->getServerParams();

        $jti = base64_encode(random_bytes(16));

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => $server["PHP_AUTH_USER"],
            "scope" => [
                "product.create",
                "product.read",
                "product.update",
                "product.delete",
                "product.list",
                "product.all"
            ]
        ];

        $secret = getenv("JWT_SECRET");
        $token = JWT::encode($payload, $secret, "HS256");

        $data["token"] = $token;
        $data["expires"] = $future->getTimeStamp();

        return $response->withStatus(201)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}
