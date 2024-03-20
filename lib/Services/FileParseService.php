<?php

namespace Services;

use Dto\FilePathInfoDto;

/**
 * Class for handling file parsing with all needed steps
 */
class FileParseService
{
    /**
     * @var FilePathInfoDto
     */
    private FilePathInfoDto $filePathInfo;

    /**
     * @var array
     */
    private array $validationErrors = [];

    /**
     * @var ValidatorService
     */
    private ValidatorService $validatorService;

    /**
     * @var ParserService
     */
    private ParserService $parserService;

    /**
     * @param string $filePath
     */
    public function __construct(
        public string $filePath
    )
    {
        $this->validatorService = new ValidatorService();
        $this->parserService = new ParserService();
    }

    public function run(): void
    {
        try {
            $this
                ->setFilePathInformation()
                ->setValidatorServiceInformation()
                ->validateFile()
                ->parseFile();
        } catch (\Exception $exception) {
            ErrorService::raise($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function getFileContent(): array
    {
        return $this->parserService->getContent();
    }

    /**
     * @return $this
     */
    protected function parseFile(): self
    {
        if (!empty($this->validationErrors)) {
            return $this;
        }

        $this->parserService
            ->setFile($this->filePathInfo)
            ->parse();

        return $this;
    }

    /**
     * @return $this
     */
    protected function validateFile(): self
    {
        if (!$this->validatorService->checkValidation()) {
            $this->validationErrors = $this->validatorService->getErrors();
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function setValidatorServiceInformation(): self
    {
        $this->validatorService->setFile($this->filePathInfo);

        return $this;
    }

    /**
     * @return $this
     */
    protected function setFilePathInformation(): self
    {
        $this->filePathInfo = FilePathInfoDto::createFromArray(
            (array)pathinfo($this->filePath)
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}