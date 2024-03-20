<?php

namespace ValidatorHandlers;

use Dto\FilePathInfoDto;

/**
 * Common class for all types of validation
 */
abstract class ValidatorHandler
{
    public function __construct(
        protected readonly FilePathInfoDto $file
    )
    {}

    abstract public function validate(): bool;

    abstract public function getErrorInformation(): string;
}