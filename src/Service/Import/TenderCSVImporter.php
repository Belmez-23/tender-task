<?php

namespace App\Service\Import;

use App\Model\TenderCsvDTO;
use App\Service\Reader\CSVReader;
use App\Service\Tender\AddTenderInterface;

class TenderCSVImporter
{
    private CSVReader $csvReader;
    private AddTenderInterface $tenderService;

    public function __construct(CSVReader $csvReader, AddTenderInterface $tenderService)
    {
        $this->csvReader = $csvReader;
        $this->tenderService = $tenderService;
    }

    public function import(string $filePath)
    {
        $rows = $this->csvReader->read($filePath);

        foreach ($rows as $row) {
            $dto = TenderCsvDTO::fromArray($row);
            $this->tenderService->addTender($dto);
        }
    }
}