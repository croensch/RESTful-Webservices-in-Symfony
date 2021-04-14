<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Repository\AttendeeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/attendees', name: 'list_attendee', methods: ['GET'])]
class ListController
{
    public function __invoke(AttendeeRepository $attendees)
    {
        $result = [];
        foreach ($attendees->findAll() as $attendee) {
            $result[] = $attendee->toArray();
        }
        return new JsonResponse($result);
    }
}
