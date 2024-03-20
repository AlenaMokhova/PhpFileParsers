<?php

namespace FileParsers;

/**
 * Class for parsing txt files
 */
class TxtFileParser extends FileParser
{
    protected function readData(): void
    {
        $result = [];
        while (!feof($this->getHandle())) {
            $result[] = fgets($this->getHandle());
        }
        $this->setData($result);
    }
}