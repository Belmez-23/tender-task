<?php

namespace App\Service\Reader;

use App\Service\Helper\Arr;

class CSVReader
{
    public function read(string $filePath, bool $withHeader = true)
    {
        $filePath = realpath($filePath);

        $file = fopen($filePath, "r");

        if ($file === false) {
            throw new \Exception("Unable to open file: ".$filePath);
        }

        $rows = [];

        while (($data = fgetcsv($file)) !== false) {
            $rows[] = $data;
        }
        fclose($file);

        if ($withHeader) {
            $rows = Arr::arrayTableToAssoc($rows);
        }

        return $rows;
    }
}