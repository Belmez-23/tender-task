<?php

namespace App\Service\Tender;

use App\Entity\Tender;
use App\Model\TenderDTO;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @implements AddTenderInterface<TenderDTO>
 */
class AddTenderService implements AddTenderInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param TenderDTO $dto
     * @return Tender|null
     */
    public function addTender($dto): ?Tender
    {
        if ($this->isTenderExist($dto->getExternalId())) {
            return null;
        }

        $tender = (new Tender())
            ->setExternalId($dto->getExternalId())
            ->setNumber($dto->getNumber())
            ->setStatus($dto->getStatus())
            ->setName($dto->getName())
            ->setUpdatedAt($dto->getUpdatedAt());

        $this->em->persist($tender);
        $this->em->flush();

        return $tender;
    }

    private function isTenderExist(int $externalId): bool
    {
        return (bool)$this->em->getRepository(Tender::class)->findOneBy(['externalId' => $externalId]);
    }
}