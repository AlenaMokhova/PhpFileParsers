<?php

namespace FileParsers;

/**
 * Class for parsing csv files
 */
class CsvFileParser extends FileParser
{
    public const SEPARATOR = ";";
    public const LIMIT_LENGTH = 1000;

    protected function readData(): void
    {
        $result = [];
        $row = 0;

        while (($data = fgetcsv($this->getHandle(), self::LIMIT_LENGTH, self::SEPARATOR)) !== false) {
            $num = count($data);
            $row++;
            for ($c = 0; $c < $num; $c++) {
                $result[$row][$c] = $data[$c];
            }
        }

        $this->setData($result);
    }
}