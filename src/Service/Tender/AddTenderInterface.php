<?php

namespace App\Service\Tender;

use App\Entity\Tender;

interface AddTenderInterface
{
    public function addTender($dto): ?Tender;
}