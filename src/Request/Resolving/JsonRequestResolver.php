<?php

declare(strict_types=1);

namespace App\Request\Resolving;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class JsonRequestResolver implements ValueResolverInterface
{
    public function __construct(private readonly DenormalizerInterface $denormalizer)
    {
    }

    /**
     * @return JsonRequestInterface[]
     */
    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        $argumentType = $argument->getType();
        if (
            !$argumentType
            || !is_subclass_of($argumentType, JsonRequestInterface::class, true)
        ) {
            return [];
        }

        // create and return the value object
        return [$this->parseRequestBody($argumentType, $request->toArray())];
    }

    /**
     * @param array<mixed, mixed> $body
     */
    private function parseRequestBody(string $type, array $body): JsonRequestInterface
    {
        try {
            return $this->denormalizer->denormalize($body, $type);
        } catch (ExceptionInterface $e) {
            throw new BadRequestException('Invalid JSON data', previous: $e);
        }
    }
}
