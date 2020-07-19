<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function signup()
    {
        $user= new User();
        $form= $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $password=$userPasswordEncoderInterface->encodePassword($user,$user->getPassword());
            $user->setPassword($password);
            $user->setRoles('ROLE_ADMIN');
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('security/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
