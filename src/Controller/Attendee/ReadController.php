<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Entity\Attendee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/attendees/{identifier}', name: 'read_attendee', methods: ['GET'])]
class ReadController
{
    public function __invoke(Attendee $attendee)
    {
        $result = $attendee->toArray();
        return new JsonResponse($result);
    }
}
