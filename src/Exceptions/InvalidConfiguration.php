<?php

namespace Bjuppa\LaravelBlog\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    /**
     * Throw exception if an object doesn't implement an interface
     *
     * @param string $interface
     * @param $implementation
     * @throws \Bjuppa\LaravelBlog\Exceptions\InvalidConfiguration
     */
    public static function throwIfInterfaceNotImplemented(string $interface, $implementation)
    {
        if (!$implementation instanceof $interface) {
            throw new static('The given instance of class `' . get_class($implementation) . "` does not implement interface `$interface`");
        }
    }
}
