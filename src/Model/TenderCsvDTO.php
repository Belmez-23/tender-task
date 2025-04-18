<?php

namespace App\Model;

use DateTimeImmutable;
use Spatie\DataTransferObject\DataTransferObject;

class TenderCsvDTO extends DataTransferObject
{
    private ?int $externalId = null;
    private ?string $number = null;
    private ?string $status = null;
    private ?string $name = null;
    private ?DateTimeImmutable $updatedAt = null;

    public static function fromArray(array $data): self
    {
        return (new self())
            ->setExternalId($data['Внешний код'] ?? null)
            ->setNumber($data['Номер'] ?? null)
            ->setStatus($data['Статус'] ?? null)
            ->setName($data['Название'] ?? null)
            ->setUpdatedAt(new DateTimeImmutable($data['Дата изм.']));
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