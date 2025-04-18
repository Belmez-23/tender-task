<?php

namespace App\Service\Tender;

use App\Entity\Tender;

interface ImportTenderInterface
{
    public function addTender($dto): ?Tender;
}