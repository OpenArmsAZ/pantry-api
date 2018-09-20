<?php
/**
 * Modify partial product data set.
 *
 * @todo - Validate against empty body (no updates)
 */
namespace OpenArms\Pantry\Product\Middleware;

use Respect\Validation\Exceptions\ValidationException;

class ModifyProductValidation extends AbstractProductValidation
{
    protected function validateRequiredRules(array $data): void
    {
        foreach ($this->getRequiredRules() as $key => $value) {
            if (empty($data[$key])) {
                // Skip validation on properties not present.
                continue;
            }

            try {
                $this->getRequiredRules()[$key]->check($data[$key]);
            } catch (ValidationException $exception) {
                $this->errors[$key] = $exception->getMainMessage();
            }
        }
    }
}
