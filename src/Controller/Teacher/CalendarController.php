<?php

namespace App\Controller\Teacher;

use App\Entity\Masterclass;
use App\Repository\MasterclassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'calendar_index')]
    public function index(MasterclassRepository $masterclasses): Response
    {   $user = $this->getUser();
        $id = $user->getId();
        $events= $masterclasses->findBy(['professor'=>$id],['date' =>'DESC']);

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

        return $this->render('teacher/calendar/index.html.twig', compact('data'));
    }
}
