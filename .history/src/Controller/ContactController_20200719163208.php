<?php

namespace App\Controller;

use App\Form\ContactType;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $swift_Mailer)
    {
        $form= $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $contact= $form->getData();
            $message= (new \Swift_Message('Nouveau contact'))
            ->setFrom($contact['email'])
            ->setTo('contact@david-lecras.fr')
            ->setBody(
                $this->render(
                    'contact/email.html.twig', compact('contact')
                ),
                'text/html'
                );
        }
        return $this->render('home/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
