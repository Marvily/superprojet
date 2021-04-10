<?php

namespace App\Controller\Student;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'calendar_index')]
    public function index(): Response
    {
        $user = $this->getUser();

        $events= $masterclasses = $user->getMasterClasses();


        $mastercalendar=[];

        foreach ($events as $event){
            $mastercalendar[]=[
                'id'=> $event->getId(),
                'title'=> $event->getTitre(),
                'start'=> $event->getHeuredebut()->format('Y-m-d H:i:s'),
                'end'=> $event->getHeurefin()->format('Y-m-d H:i:s'),

            ];
        }
        $data = json_encode($mastercalendar);
        return $this->render('student/calendar/index.html.twig', compact('data'));
    }

}

