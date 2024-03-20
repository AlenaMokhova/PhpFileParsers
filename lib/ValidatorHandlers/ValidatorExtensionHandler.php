<?php

namespace ValidatorHandlers;

use Services\ParserService;

/**
 * Class for validating extensions of files
 */
class ValidatorExtensionHandler extends ValidatorHandler
{
    protected const ERROR_TEXT = 'File\'s extension is not allowed';

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $extensions = array_keys(ParserService::PARSERS_LIST);
        return in_array($this->file->getExtension(), $extensions, true);
    }

    /**
     * @return string
     */
    public function getErrorInformation(): string
    {
        return self::ERROR_TEXT;
    }
}