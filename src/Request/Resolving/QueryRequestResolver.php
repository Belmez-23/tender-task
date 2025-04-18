<?php

namespace App\Request\Resolving;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class QueryRequestResolver implements ValueResolverInterface
{
    public function __construct(private readonly DenormalizerInterface $denormalizer)
    {
    }

    /**
     * @return QueryRequestInterface[]
     */
    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        $argumentType = $argument->getType();
        if (
            !$argumentType
            || !is_subclass_of($argumentType, QueryRequestInterface::class, true)
        ) {
            return [];
        }
        // create and return the value object
        return [$this->parseRequestQuery($argumentType, $request->query->all())];
    }

    /**
     * @param array<mixed, mixed> $body
     */
    private function parseRequestQuery(string $type, array $body): QueryRequestInterface
    {
        try {
            return $this->denormalizer->denormalize($body, $type, 'array', [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true]);
        } catch (ExceptionInterface $e) {
            throw new BadRequestException('Invalid query data', previous: $e);
        }
    }
}
