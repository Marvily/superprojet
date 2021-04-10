<?php

namespace App\Controller\Teacher;

use App\Entity\Masterclass;
use App\Form\Teacher\LearningRoomsType;
use App\Repository\MasterclassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

#[Route('/learningrooms')]
class LearningRoomsController extends AbstractController
{
    #[Route('/', name: 'learning_rooms')]
    public function index(MasterclassRepository $masterclassRepository): Response
    {
        $user=$this->getUser();
        $id =$user->getId();
        $masterclasses = $masterclassRepository->findBy(['professor'=>$id],['date' =>'DESC']);
        return $this->render('teacher/learning_rooms/index.html.twig', [
            'user' => $user,
            'masterclasses'=> $masterclasses,
        ]);
    }

    #[Route('/new', name: 'learning_rooms_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $masterclass = new Masterclass();
        $form = $this->createForm(LearningRoomsType::class, $masterclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $user=$this->getUser();

            $masterclass->setProfessor($user);
            $masterclass->setStatus('À terminer');
            $entityManager->persist($masterclass);
            $entityManager->flush();

            return $this->redirectToRoute('learning_rooms');
        }

        return $this->render('teacher/learning_rooms/new.html.twig', [
            'masterclass' => $masterclass,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'learning_rooms_show', methods: ['GET'])]
    public function show(Masterclass $masterclass): Response
    {
        return $this->render('teacher/learning_rooms/show.html.twig', [
            'masterclass' => $masterclass,
        ]);
    }

    #[Route('/{id}/edit', name: 'learning_rooms_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Masterclass $masterclass): Response
    {
        $form = $this->createForm(LearningRoomsType::class, $masterclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('learning_rooms');
        }

        return $this->render('teacher/learning_rooms/edit.html.twig', [
            'masterclass' => $masterclass,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'learning_rooms_delete', methods: ['POST'])]
    public function delete(Request $request, Masterclass $masterclass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$masterclass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($masterclass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('learning_rooms');
    }

    #[Route('/{id}/close', name: 'learning_rooms_close', methods: ['GET','POST'])]
    public function closeClasse( Masterclass $masterclass): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $masterclass->setStatus('Terminé');
            $entityManager->persist($masterclass);
            $entityManager->flush();


        return $this->redirectToRoute('learning_rooms');
    }
}
