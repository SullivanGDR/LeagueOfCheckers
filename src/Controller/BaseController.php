<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Joueur;
use App\Entity\Partie;
use App\Entity\ThemePion;

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
    #[Route('/jouer', name: 'jouer')]
    public function jouer(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {    
        $parties = $entityManagerInterface->getRepository(Partie::class)->findAll();
        return $this->render('base/jouer.html.twig', [
            "parties" => $parties
        ]);
    }
    #[Route('/profil/{id}', name: 'profil')]
    public function profil(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {    
        $id = $request->get('id');

        $joueur = $entityManagerInterface->getRepository(Joueur::class)->find($id);

        $parties = $entityManagerInterface->getRepository(Partie::class)->createQueryBuilder('p')
        ->where('p.joueurN = :joueur OR p.joueurB = :joueur')
        ->setParameter('joueur', $joueur)
        ->getQuery()
        ->getResult();

        $themepion = $entityManagerInterface->getRepository(ThemePion::class)->findAll();

        return $this->render('base/profil.html.twig', [
            "joueur" => $joueur,
            "parties" => $parties,
            "themePion" => $themepion
        ]);
    }
    #[Route('/boutique', name: 'boutique')]
    public function boutique(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {    
        $themepion = $entityManagerInterface->getRepository(ThemePion::class)->findAll();
        return $this->render('base/boutique.html.twig', [
            "themePion" => $themepion
        ]);
    }
    #[Route('/achat-pion/{id}', name: 'achat-pion')]
    public function achatPion(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {    
        $id = $request->get('id');

        $themepion = $entityManagerInterface->getRepository(ThemePion::class)->find($id);

        $user = $this->getUser();

        $user->addCasier($themepion);

        $user->setMonnaie($user->getMonnaie() - 500);

        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('boutique');

        return $this->render('base/boutique.html.twig', [
        ]);
    }
    #[Route('/equiper/{id}', name: 'equiper-pion')]
    public function equiperPion(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {    
        $id = $request->get('id');

        $themepion = $entityManagerInterface->getRepository(ThemePion::class)->find($id);

        $user = $this->getUser();

        $user->setThemePion($themepion);

        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('profil', ['id' => $user->getId()]);

        return $this->render('base/boutique.html.twig', [
        ]);
    }
}
