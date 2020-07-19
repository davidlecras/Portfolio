<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjectRepository $projectRepository, Request $request, \Swift_Mailer $swift_Mailer)
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
            $swift_Mailer->send($message);
            $this->addFlash('success', 'Votre message a bien été envoyé, les abeilles vous répondrons le plus rapidement possible');
            return $this->redirectToRoute('home');
        }
        $projects= $projectRepository->findAll();
        return $this->render('home/index.html.twig', [
            'projects' => $projects,
            'contactForm' => $form->createView(),
        ]);
    }
}
