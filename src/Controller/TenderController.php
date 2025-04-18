<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\GetTendersRequest;
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

        return new JsonResponse($data);
    }

    #[Route('/tenders/{id}', name: 'tenders_get_by_id')]
    public function getById(int $id, GetTendersInterface $service): JsonResponse
    {
        $tender = $service->getTenderByExternalId($id);
        $data = $this->normalizer->normalize($tender);

        return new JsonResponse($data);
    }
}
