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
        $partie->setNbCoupJ1(0);
        $partie->setNbCoupJ2(0);
        $partie->setCodePartie("test");
        $partie->setEtatPartie(0);
        $partie->setEtatPlateau(0);
        $partie->setDatePartie(new \Datetime);
        $partie->setJoueur1($user);

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

        if($partie->getJoueur1() == $user) {
            return $this->redirectToRoute('partie', ['id' => $partie->getId()]);
        } else {
            $partie->setJoueur2($user);
        }

        $entityManagerInterface->persist($partie);
        $entityManagerInterface->flush();

        return $this->render('partie/index.html.twig', [
        ]);
    }
}
