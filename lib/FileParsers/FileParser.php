<?php

namespace FileParsers;

use Dto\FilePathInfoDto;

/**
 * Common abstract class for all types of file parsers
 * Each child class must define readData() method
 */
abstract class FileParser
{
    public const READ_FILE_MODE = 'rb';

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var resource|closed-resource
     */
    protected mixed $handle;

    /**
     * @var bool
     */
    protected bool $isFileOpenedWithError = false;

    /**
     * @param FilePathInfoDto $file
     */
    public function __construct(
        protected readonly FilePathInfoDto $file
    )
    {
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    protected function setData(array $data): void
    {
        $this->data = $data;
    }

    public function parse(): void
    {
        $this->fileOpen();
        if (!$this->isFileOpenedWithError) {
            $this->readData();
            $this->fileClose();
        }
    }

    protected function fileOpen(): void
    {
        $f = fopen(
            __DIR__ . '/../..' . $this->file->getPathAsString(),
            self::READ_FILE_MODE
        );
        if ($f === false) {
            $this->isFileOpenedWithError = true;
        }   else {
            $this->handle = $f;
            $this->isFileOpenedWithError = false;
        }
    }

    abstract protected function readData(): void;

    protected function fileClose(): void
    {
        if (is_resource($this->handle)) {
            fclose($this->handle);
        }
    }

    protected function getHandle()
    {
        return $this->handle;
    }
}