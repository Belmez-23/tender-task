<?php

namespace App\Request;

use App\Request\Resolving\JsonRequestInterface;

final readonly class AddTenderRequest implements Resolving\JsonRequestInterface
{
    public function __construct(
        public int $externalId,
        public string $number,
        public string $name = '',
        public string $status = '',
    ) {
    }
}