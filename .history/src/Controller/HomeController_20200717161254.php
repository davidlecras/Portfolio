<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjectRepository $projectRepository)
    {
        $projects= $projectRepository->findAll();
        return $this->render('home/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
