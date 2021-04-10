<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/configurations')]
class ConfigurationsController extends AbstractController
{
    #[Route('/', name: 'configurations')]
    public function index(): Response
    {
        return $this->render('admin/configurations/index.html.twig');
    }
}
