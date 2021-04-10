<?php

namespace App\Controller\Student;

use App\Entity\Masterclass;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/learningrooms')]
class LearningRoomsController extends AbstractController
{
    #[Route('/', name: 'learning_rooms')]
    public function index(UserRepository $userRepository): Response
    {
        $user=$this->getUser();
        $masterclasses = $user->getMasterClasses();
        return $this->render('student/learning_rooms/index.html.twig', [
            'user' => $user,
            'masterclasses'=> $masterclasses,
        ]);

    }
    #[Route('/{id}', name: 'learning_rooms_show', methods: ['GET'])]
    public function show(Masterclass $masterclass): Response
    {
        return $this->render('student/learning_rooms/show.html.twig', [
            'masterclass' => $masterclass,
        ]);
    }

}
