<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Partie;

class PartieController extends AbstractController
{
    #[Route('/creation-partie', name: 'creation-partie')]
    public function index(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();

        $partie = new Partie();
        $partie->setJoueurN($user);
        $partie->setDatePartie(new \Datetime);
        $partie->setNbCoupJB(0);
        $partie->setNbCoupJN(0);
        $partie->setNbTour(0);
        $partie->setNbPionN(20);
        $partie->setNbPionB(20);
        $partie->setCodePartie(''.$partie->getId());

        $entityManagerInterface->persist($partie);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('partie', ['id' => $partie->getId()]);
    }

    #[Route('/partie/{id}', name: 'partie')]
    public function partie(Request $request , EntityManagerInterface $entityManagerInterface, SluggerInterface $slugger): Response
    {
        $id = $request->get('id');

        $partie = $entityManagerInterface->getRepository(Partie::class)->find($id);

        $user = $this->getUser();

        if ($partie->getJoueurB() === null || $partie->getJoueurB() === $user) { // Condition pour attribuer le joueur B.
            if ($partie->getJoueurN() != $user) {
                $partie->setJoueurB($user);
            }
        } else if ($partie->getJoueurN() === $user) { // Si le joueur N rejoint ont le remets à sa place.
            $partie->setJoueurN($user);
        } else {
            // La partie est déjà pleine, rediriger vers l'index.
            return $this->redirectToRoute('index');
        }

        $entityManagerInterface->persist($partie);
        $entityManagerInterface->flush();

        return $this->render('partie/index.html.twig', [
            "partie" => $partie,
        ]);
    }
}
