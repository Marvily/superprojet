<?php

namespace App\Controller\Admin;

use App\Entity\Masterclass;
use App\Form\Admin\MasterclassType;
use App\Repository\MasterclassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/masterclass')]
class MasterclassController extends AbstractController
{
    #[Route('/', name: 'masterclass_index', methods: ['GET'])]
    public function index(MasterclassRepository $masterclassRepository): Response
    {
        return $this->render('admin/masterclass/index.html.twig', [
            'masterclasses' => $masterclassRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'masterclass_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $masterclass = new Masterclass();
        $form = $this->createForm(MasterclassType::class, $masterclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $masterclass->setStatus('À terminer');
            $entityManager->persist($masterclass);
            $entityManager->flush();

            return $this->redirectToRoute('masterclass_index');
        }

        return $this->render('admin/masterclass/new.html.twig', [
            'masterclass' => $masterclass,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'masterclass_show', methods: ['GET'])]
    public function show(Masterclass $masterclass): Response
    {
        return $this->render('admin/masterclass/show.html.twig', [
            'masterclass' => $masterclass,
        ]);
    }

    #[Route('/{id}/edit', name: 'masterclass_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Masterclass $masterclass): Response
    {
        $form = $this->createForm(MasterclassType::class, $masterclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('masterclass_index');
        }

        return $this->render('admin/masterclass/edit.html.twig', [
            'masterclass' => $masterclass,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'masterclass_delete', methods: ['POST'])]
    public function delete(Request $request, Masterclass $masterclass): Response
    {
        if ($this->isCsrfTokenValid('delete'.$masterclass->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($masterclass);
            $entityManager->flush();
        }

        return $this->redirectToRoute('masterclass_index');
    }
}
