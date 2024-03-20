<?php

namespace Services;

use Dto\FilePathInfoDto;
use ValidatorHandlers\ValidatorExtensionHandler;
use ValidatorHandlers\ValidatorHandler;

/**
 * Class for handling all validation classes at once
 */
class ValidatorService
{
    protected const VALIDATORS_LIST = [
        ValidatorExtensionHandler::class
    ];

    /**
     * @var FilePathInfoDto
     */
    private FilePathInfoDto $file;

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @param FilePathInfoDto $file
     *
     * @return $this
     */
    public function setFile(FilePathInfoDto $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return bool
     */
    public function checkValidation(): bool
    {
        foreach (self::VALIDATORS_LIST as $validator) {
            /** @var ValidatorHandler $v */
            $v = new $validator($this->file);
            if (!$v->validate()) {
                $this->addError($v->getErrorInformation());
            }
        }

        return empty($this->getErrors());
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param string $error
     */
    private function addError(string $error): void
    {
        $this->errors[] = $error;
    }
}