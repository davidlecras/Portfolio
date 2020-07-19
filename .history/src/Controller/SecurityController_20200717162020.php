<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("admin/security", name="security")
     */
    public function signup(Request $request, UserPasswordEncoderInterface $userPasswordEncoderInterface, EntityManagerInterface $entityManagerInterface)
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

    /**
     * @Route("/signin", name="signin")
     */
    public function signin(AuthenticationUtils $authenticationUtils)
    {   
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/signin.html.twig', [
            'lastUserName' => $authenticationUtils->getLastUsername(),
            'error' => $error !== null,
        ]);
    }

}
