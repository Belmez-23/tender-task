<?php

namespace App\Model;

use App\Request\AddTenderRequest;
use DateTimeImmutable;
use Spatie\DataTransferObject\DataTransferObject;

class TenderDTO extends DataTransferObject
{
    private ?int $externalId = null;
    private ?string $number = null;
    private ?string $status = null;
    private ?string $name = null;
    private ?DateTimeImmutable $updatedAt = null;

    public static function fromRequest(AddTenderRequest $request): self
    {
        return (new self())
            ->setExternalId($request->externalId)
            ->setNumber($request->number)
            ->setStatus($request->status)
            ->setName($request->name)
            ->setUpdatedAt(new DateTimeImmutable());
    }

    public function getExternalId(): ?int
    {
        return $this->externalId;
    }

    public function setExternalId(int $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}