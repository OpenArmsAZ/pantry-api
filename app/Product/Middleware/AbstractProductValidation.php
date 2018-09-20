<?php

namespace OpenArms\Pantry\Product\Middleware;

use Psr\Container\ContainerInterface;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class AbstractProductValidation
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(
        Request $request,
        Response $response,
        callable $next = null
    ) {
        $input = $request->getParsedBody() ?? [];

        if ($this->isValid($input)) {
            return $next($request, $response);
        }

        return $response
            ->withJson(
                ['errors' => $this->errors],
                200
            );
    }

    private function isValid(array $data): bool
    {
        $this->checkForUnnecessaryProperties($data);
        $this->validateRequiredRules($data);
        $this->validateOptionalRules($data);

        if (!empty($this->errors)) {
            return false;
        }

        return true;
    }

    private function checkForUnnecessaryProperties(array $data): void
    {
        $unnecessary_properties = array_diff_key(
            $data,
            $this->getRequiredRules(),
            $this->getOptionalRules()
        );

        if (!empty($unnecessary_properties)) {
            foreach ($unnecessary_properties as $key => $value) {
                $this->errors[$key] = 'Invalid property.';
            }
        }
    }

    protected function validateRequiredRules(array $data): void
    {
        foreach ($this->getRequiredRules() as $key => $value) {
            if (empty($data[$key])) {
                $this->errors[$key] = 'Required value.';
                continue;
            }

            try {
                $this->getRequiredRules()[$key]->check($data[$key]);
            } catch (ValidationException $exception) {
                $this->errors[$key] = $exception->getMainMessage();
            }
        }
    }

    /**
     * @return Validator[]
     */
    protected function getRequiredRules(): array
    {
        return [
            'name' => v::stringType()->length(1, 45),
        ];
    }

    protected function validateOptionalRules(array $data): void
    {
        foreach ($this->getOptionalRules() as $key => $value) {
            if (empty($data[$key])) {
                continue;
            }

            try {
                $this->getOptionalRules()[$key]->check($data[$key]);
            } catch (ValidationException $exception) {
                $this->errors[$key] = $exception->getMainMessage();
            }
        }
    }

    protected function getOptionalRules(): array
    {
        return [
            'description' => v::optional(v::stringType()),
            'upc' => v::optional(v::stringType()),
            'shareable_quantity' => v::optional(v::intType())
        ];
    }
}
