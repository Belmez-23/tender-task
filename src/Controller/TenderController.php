<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\TenderDTO;
use App\Request\AddTenderRequest;
use App\Request\GetTendersRequest;
use App\Service\Tender\AddTenderInterface;
use App\Service\Tender\GetTendersInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TenderController extends AbstractController
{
    private NormalizerInterface $normalizer;

    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    #[Route('/tenders', name: 'tenders')]
    public function getList(GetTendersRequest $request, GetTendersInterface $service): JsonResponse
    {
        $tenders = $service->getTenders(
            $request->page,
            $request->limit,
            $request->name,
            $request->getConvertedDate()
        );

        $data = $this->normalizer->normalize($tenders);

        return new JsonResponse([
            'data' => $data,
            'pagination' => [
                'page' => $request->page,
                'limit' => $request->limit,
                'items' => $service->getTenderCount($request->name, $request->getConvertedDate()),
            ],
        ]);
    }

    #[Route('/tenders/{id}', name: 'tenders_get_by_id')]
    public function getById(int $id, GetTendersInterface $service): JsonResponse
    {
        $tender = $service->getTender($id);
        $data = $this->normalizer->normalize($tender);

        return new JsonResponse(['data' => $data]);
    }

    #[Route('/tenders/', name: 'tenders_add', methods: ['POST'])]
    public function addTender(AddTenderRequest $request, AddTenderInterface $service): JsonResponse
    {
        $tender = $service->addTender(TenderDTO::fromRequest($request));

        if (!$tender) {
            return new JsonResponse(['message' => 'Unable to create a tender'], 400);
        }

        $data = $this->normalizer->normalize($tender);

        return new JsonResponse(['data' => $data], 201);
    }
}
