<?php

namespace App\Controller;

use App\Entity\Joueur;
use App\Entity\Rang;
use App\Entity\ThemePion;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Joueur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $theme = $entityManager->getRepository(ThemePion::class)->find(1);
            $user->setNbVictoire(0);
            $user->setNbDefaite(0);
            $user->setNbTotalePartie(0);
            $user->setRang($entityManager->getRepository(Rang::class)->find(1));
            $user->setThemePion($theme);
            $user->addCasier($theme);
            $user->setMonnaie(500);
            $user->setPointsRang(0);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            //return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
