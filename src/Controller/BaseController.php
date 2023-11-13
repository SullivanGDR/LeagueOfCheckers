<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Joueur;

class BaseController extends AbstractController
{
    #[Route('/base', name: 'index')]
    public function index(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {
        $joueurs = $entityManagerInterface->getRepository(Joueur::class)->findBy([], ['pointsRang' => 'DESC'], 5);

        return $this->render('base/index.html.twig', [
            "joueurs" => $joueurs
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
    #[Route('/classement', name: 'classement')]
    public function classe(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {
        $joueurs = $entityManagerInterface->getRepository(Joueur::class)->findBy([], ['pointsRang' => 'DESC']);
        return $this->render('base/classement.html.twig', [
            "joueurs" => $joueurs
        ]);
    }
}
