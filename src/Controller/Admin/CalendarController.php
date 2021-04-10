<?php

namespace App\Controller\Admin;

use App\Entity\Masterclass;
use App\Repository\MasterclassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

#[Route('/calendar')]
class CalendarController extends AbstractController
{
    #[Route('/', name: 'calendar_index')]
    public function index(MasterclassRepository $masterclasses): Response
    {

        $events= $masterclasses->findAll();

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
        return $this->render('admin/calendar/index.html.twig', compact('data'));
    }

    #[Route('/api/{id}/edit', name: 'calendar_api_edit', methods:['PUT'])]
    public function api(?Masterclass $masterclass, Request $request): Response
    {

        $donnees = json_decode($request->getContent());

        if(isset($donnees->title) && !empty($donnees->title) && isset($donnees->start) && !empty($donnees->start) && isset($donnees->end) && !empty($donnees->end))
        {
            $code = 200;
            if (!$masterclass)
            {
                $masterclass = new Masterclass();
                $code= 201;
            }

            $masterclass->setTitre($donnees->title);
            $masterclass->setHeuredebut(new DateTime($donnees->start));
            $masterclass->setHeurefin(new DateTime($donnees->start));

            $em=$this->getDoctrine()->getManager();
            $em->persist($masterclass);
            $em->flush();

            return new Response('OK', $code);

        }else
            {
                return new Response('Données Incompletes', 404);
            }


    }
}
