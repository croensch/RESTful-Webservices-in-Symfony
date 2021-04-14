<?php

namespace App\Serializer;

use App\Entity\Workshop;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class WorkshopNormalizer implements ContextAwareNormalizerInterface
{
    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = [])
    {
        return $data instanceof Workshop;
    }

    public function normalize($object, ?string $format = null, array $context = [])
    {
        $context = array_merge($context, [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['id'],
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (Workshop $object, $format, $context) {
                return $object->getTitle();
            },
        ]);

        return $this->normalizer->normalize($object, $format, $context);
    }
}
