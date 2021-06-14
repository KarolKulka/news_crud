<?php
declare(strict_types=1);

namespace App\Entity;

use App\Helper\GlobalHelper;
use ReflectionException;

/**
 * Class BaseEntity
 * @package App\Entity
 */
abstract class BaseEntity
{
    /**
     * Automatically fill entity properties based on DB column name
     *
     * @param array $dataToFill
     * @return self
     * @throws ReflectionException
     */
    public function fillProperties(array $dataToFill): self
    {
        foreach ($dataToFill as $propertyName => $propertyValue) {
            if (property_exists($this, $propertyName)) {
                $propertyReflection = new \ReflectionProperty($this, $propertyName);
                if (gettype($propertyValue) !== $propertyReflection->getType()->getName()) {
                    $propertyValue = GlobalHelper::castToType($propertyValue, gettype($this->$propertyName));
                }
            }

            $this->$propertyName = $propertyValue;
        }

        return $this;
    }
}
