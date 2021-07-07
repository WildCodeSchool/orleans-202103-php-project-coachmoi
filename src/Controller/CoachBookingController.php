<?php

namespace App\Controller;

use App\Entity\CoachBooking;
use App\Entity\Client;
use App\Entity\Activity;
use App\Entity\Coach;
use App\Repository\CoachBookingRepository;
use App\Repository\CoachRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/demandes")
 * @isGranted("ROLE_SUPERADMIN")
 */
class CoachBookingController extends AbstractController
{
    /**
     * @Route("/", name="coach_booking_index", methods={"GET"})
     * @isGranted("ROLE_SUPERADMIN")
     */
    public function index(CoachBookingRepository $coachBookingRepo): Response
    {
        return $this->render('coach_booking/index.html.twig', [
            'coach_bookings' => $coachBookingRepo->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="coach_booking_show", methods={"GET", "POST"})
     */
    public function show(CoachBooking $coachBooking): Response
    {
        return $this->render('coach_booking/show.html.twig', [
            'coach_booking' => $coachBooking
        ]);
    }

    /**
    * @Route("/demandes/{id}/{activity_id}/coachs", name="show_coachs_byActivity", methods={"GET", "POST"}))
    * @ParamConverter("activity", class="App\Entity\Activity", options={"mapping": {"activity_id": "id"}})
    */
    public function showCoachByAct(CoachBooking $booking, Activity $activity, CoachRepository $coachRepo): Response
    {
        $coachs = $coachRepo->myFindByActivity($activity);

        return $this->render('coach_booking/list_availablecoachs.html.twig', [
            'coachs' => $coachs,
            'activity' => $activity,
            'coach_booking' => $booking,
        ]);
    }
}