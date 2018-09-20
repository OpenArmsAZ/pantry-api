<?php
namespace OpenArms\Pantry\Authentication;

class Token
{
    public $decoded;

    public function populate($decoded)
    {
        $this->decoded = $decoded;
    }

    public function hasScope(array $scope)
    {
        return !!count(array_intersect($scope, $this->decoded["scope"]));
    }
}
