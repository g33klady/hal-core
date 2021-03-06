<?php
/**
 * @copyright (c) 2017 Quicken Loans Inc.
 *
 * For full license information, please view the LICENSE distributed with this source code.
 */

namespace Hal\Core\Type;

trait EnumTrait
{
    /**
     * Is the provided value a valid entry for this enum?
     *
     * @param mixed $option
     *
     * @return bool
     */
    public static function isValid($option)
    {
        return in_array($option, static::options(), true);
    }

    /**
     * Ensure the provided value is a valid type. Throw an exception if not.
     *
     * @param mixed $option
     *
     * @throws EnumException
     *
     * @return string
     */
    public static function ensureValid($option)
    {
        if (is_string($option)) {
            $option = strtolower($option);
        }

        if (!self::isValid($option)) {
            $option = is_scalar($option) ? $option : gettype($option);

            $parts = explode('\\', __CLASS__);
            $class = array_pop($parts);

            throw new EnumException(sprintf('"%s" is not a valid %s option.', $option, $class));
        }

        return $option;
    }
}
