<?php
/**
 * Isaiah 40:29 KJV
 * He giveth power to the faint; and to them that have no might he increaseth strength.
 */
namespace OpenArms\Pantry\Entities;

abstract class AbstractEntity implements \JsonSerializable
{
    public function __construct(array $data = null)
    {
        if (!is_null($data)) {
            $this->hydrate($data);
        }
    }

    public function hydrate(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            if (is_null($value)) {
                continue;
            }
            $method = $this->getSetterMethod($key);

            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    private function getSetterMethod($propertyName)
    {
        return "set" . str_replace(' ', '', ucwords(str_replace('_', ' ', $propertyName)));
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $data = get_object_vars($this);
        foreach ($data as $key => $value) {
            if (substr($key, 0, 2) === '__') {
                // Remove the doctrine '__initializer__', '__cloner__', etc...
                unset($data[$key]);
            }

            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
                $data[$key] = $value;
            }
        }

        return $data;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
