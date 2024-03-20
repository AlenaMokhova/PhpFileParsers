<?php

namespace Service;

use Services\FileParseService;

/**
 * Class for starting all logic work together
 */
class StartService
{
    public const UPLOAD_DIRECTORY = 'upload';

    private array $files;

    /**
     * @return StartService
     */
    public static function getInstance(): self
    {
        return new self;
    }

    public function run(): void
    {
        $this->scanDirectory();
        $this->parseFiles();
    }

    private function scanDirectory(): void
    {
        if (!$this->isFilesFolderExists()) {
            $this->files = [];
            return;
        }

        $files = [];
        $filesInDir = scandir(self::UPLOAD_DIRECTORY);
        if ($filesInDir !== false) {
            $files = array_filter($filesInDir, static function ($e)
            {
                return $e !== '.' && $e !== '..';
            });
        }

        $this->files = $files;
    }

    private function isFilesFolderExists(): bool
    {
        return file_exists(self::UPLOAD_DIRECTORY);
    }

    private function parseFiles(): void
    {
        foreach ($this->files as $file) {
            $fileParseService = new FileParseService(
                filePath: '/' . self::UPLOAD_DIRECTORY . '/' . $file,
            );
            $fileParseService->run();

            $this->printInfo($file, $fileParseService);
        }
    }

    private function printInfo(string $file, FileParseService $fileParseService): void
    {
        print_r("File: " . $file . "\n");
        print_r("Count errors of validation: " . count($fileParseService->getValidationErrors()) . "\n");
        if (count($fileParseService->getValidationErrors()) > 0) {
            print_r(implode("\n", $fileParseService->getValidationErrors()));
        } else {
            print_r($fileParseService->getFileContent());
        }
        print_r("\n");
    }
}