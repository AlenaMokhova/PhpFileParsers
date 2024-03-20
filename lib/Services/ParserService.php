<?php

namespace Services;

use Dto\FilePathInfoDto;
use FileParsers\CsvFileParser;
use FileParsers\FileParser;
use FileParsers\TxtFileParser;

/**
 * Class for handling all parsers at once
 */
class ParserService
{
    public const PARSERS_LIST = [
        'csv' => CsvFileParser::class,
        'txt' => TxtFileParser::class
    ];

    /**
     * @var FilePathInfoDto
     */
    private FilePathInfoDto $file;

    /**
     * @var FileParser|null
     */
    private ?FileParser $fileParser = null;

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
     *
     */
    public function parse(): void
    {
        $this->setParser();
        $this->fileParser?->parse();
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        return $this->fileParser?->getData() ?? [];
    }

    protected function setParser(): void
    {
        if (!isset(self::PARSERS_LIST[$this->file->getExtension()])) {
            return;
        }
        $this->fileParser = new (self::PARSERS_LIST[$this->file->getExtension()])($this->file);
    }
}