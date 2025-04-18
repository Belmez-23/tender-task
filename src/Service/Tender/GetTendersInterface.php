<?php

namespace App\Service\Tender;

use App\Entity\Tender;
use DateTimeImmutable;

interface GetTendersInterface
{
    /**
     * @return Tender[]|null
     */
    public function getTenders(int $page, int $limit, ?string $name, ?DateTimeImmutable $date): ?array;

    public function getTender(int $id): ?Tender;

    public function getTenderByExternalId(int $id): ?Tender;
}