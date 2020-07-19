<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        $form= $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
