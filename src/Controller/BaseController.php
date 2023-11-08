<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/base', name: 'index')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
        ]);
    }
    #[Route('/damier', name: 'damier')]
    public function damier(): Response
    {
        return $this->render('base/damier.html.twig', [
        ]);
    }
    #[Route('/rangs', name: 'rangs')]
    public function rangs(): Response
    {
        return $this->render('base/rangs.html.twig', [
        ]);
    }
    #[Route('/classements', name: 'classements')]
    public function classe(): Response
    {
        return $this->render('base/classe.html.twig', [
        ]);
    }
}
