<?php

namespace App\Request;


use App\Request\Resolving\QueryRequestInterface;
use DateTimeImmutable;

final readonly class GetTendersRequest implements QueryRequestInterface
{
    public function __construct(
        public string $name = '',
        public string $date = '',
        public int $page = 0,
        public int $limit = self::DEFAULT_LIMIT,
    ) {
    }

    public function getConvertedDate(): ?DateTimeImmutable
    {
        return $this->date ? new DateTimeImmutable($this->date) : null;
    }
}