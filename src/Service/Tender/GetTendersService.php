<?php

namespace App\Service\Tender;

use App\Entity\Tender;
use App\Repository\TenderRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class GetTendersService implements GetTendersInterface
{
    private EntityManagerInterface $em;
    /** @var TenderRepository $repository */
    private \Doctrine\ORM\EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $entityManager->getRepository(Tender::class);
    }

    /**
     * @param int $page
     * @param int $limit
     * @param string|null $name
     * @param DateTimeImmutable|null $date
     * @return Tender[]|null
     */
    public function getTenders(int $page, int $limit, ?string $name = null, ?DateTimeImmutable $date = null): ?array
    {
        $qb = $this->repository->createQueryBuilder('t')
            ->orderBy('t.updatedAt', 'ASC');

        $this->filterTenders($qb, $name, $date);

        return $qb->setFirstResult($page * $limit)->setMaxResults($limit)->getQuery()->getResult() ?: null;
    }

    public function getTenderCount(?string $name, ?DateTimeImmutable $date): int
    {
        $qb = $this->repository->createQueryBuilder('t')
            ->select('COUNT(t.id)');

        $this->filterTenders($qb, $name, $date);

        return $qb->getQuery()->getSingleScalarResult() ?: 0;
    }

    private function filterTenders(QueryBuilder &$qb, ?string $name, ?DateTimeImmutable $date): void
    {
        if ($name) {
            $qb->andWhere('t.name LIKE :name')
                ->setParameter('name', '%'.$name.'%');
        }

        if ($date) {
            $qb->andWhere('DATE_FORMAT(t.updatedAt, \'%Y-%m-%d\') = :date')
                ->setParameter('date', $date->format('Y-m-d'));
        }
    }

    public function getTender(int $id): ?Tender
    {
        return $this->repository->find($id);
    }

    public function getTenderByExternalId(int $id): ?Tender
    {
        return $this->repository->findOneBy(['externalId' => $id]);
    }
}