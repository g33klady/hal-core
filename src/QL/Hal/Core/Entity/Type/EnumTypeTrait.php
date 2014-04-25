<?php
# src/QL/Hal/Core/Entity/Type/AbstractEnumType.php

namespace QL\Hal\Core\Entity\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use InvalidArgumentException;

/**
 *  Abstract Doctrine Enum Type
 *
 *  @author Matt Colf <matthewcolf@quickenloans.com>
 */
trait EnumTypeTrait
{
    /**
     *  Convert Enum to database value
     *
     *  @param mixed $value
     *  @param AbstractPlatform $platform
     *  @return string|null
     *  @throws InvalidArgumentException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, $this->values)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for enum. Must be one of %s.",
                    (string)$value,
                    $this->valuesAsString()
                )
            );
        }

        return $value;
    }

    /**
     *  Convert database value to string
     *
     *  @param mixed $value
     *  @param AbstractPlatform $platform
     *  @return null|string
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    /**
     *  Get the Enum field definition
     *
     *  @param array $fieldDeclaration
     *  @param AbstractPlatform $platform
     *  @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = $this->valuesAsString();

        return "ENUM(".$values.") COMMENT '(DC2Type:".static::TYPE.")'";
    }

    /**
     *  Get the type name
     *
     *  @return string
     */
    public function getName()
    {
        return static::TYPE;
    }

    /**
     *  Get a string representation of valid enum values
     *
     * @return string
     */
    private function valuesAsString()
    {
        $values =  array_map(function ($val) {
            return "'$val'";
        }, $this->values);

        return implode(', ', $values);
    }
}
