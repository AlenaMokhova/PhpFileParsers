<?php

namespace Services;

class ErrorService
{
    public const TEXT_BEFORE_MESSAGE = 'Error!';

    /**
     * @param string $message
     */
    public static function raise(string $message): void
    {
        print_r(self::TEXT_BEFORE_MESSAGE . ' ' . $message);
    }
}