<?php

namespace App\Serializer;

use App\Entity\Attendee;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class AttendeeNormalizer implements ContextAwareNormalizerInterface
{
    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function supportsNormalization($data, ?string $format = null, array $context = [])
    {
        return $data instanceof Attendee;
    }

    public function normalize($object, ?string $format = null, array $context = [])
    {
        $context = array_merge($context, [
            AbstractNormalizer::IGNORED_ATTRIBUTES => ['id'],
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (Attendee $object, $format, $context) {
                return $object->getFirstname() . ' ' . $object->getLastname();
            },
        ]);

        return $this->normalizer->normalize($object, $format, $context);
    }
}
