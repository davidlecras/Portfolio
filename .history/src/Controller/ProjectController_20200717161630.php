<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/projects", name="projects")
     */
    public function index(ProjectRepository $projectRepository)
    {
        $projects = $projectRepository->findAll();
        return $this->render('projects/index.html.twig', [
            'projects' => $projects,
        ]);
    }

        /**
     * @Route("/project/add", name="project_add")
     *  * @Route("/project/modify/{id}", name="project_modify", methods="GET|POST")
     */
    public function edit(Project $project = null, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        if (!$project) {
            $project = new Project();
            $project->setCreatedAt(new \DateTime());
        }
        $formP = $this->createForm(ProjectType::class, $project);
        $formP->handleRequest($request);
        if ($formP->isSubmitted() && $formP->isValid()) {
            $entityManagerInterface->persist($project);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('projects');
        }
        return $this->render('projects/edit.html.twig', [
            'projetcs' => $project,
            'formP' => $formP->createView(),
        ]);
    }

    /**
     * @Route("/project/remove/{id}", name="project_remove", methods="delete")
     */
    public function remove(Project $project, Request $request, EntityManagerInterface $manager)
    {
        if ($this->isCsrfTokenValid("SUP" . $project->getid(), $request->get('_token'))) {
            $manager->remove($project);
            $manager->flush();
            return $this->redirectToRoute("projects");
        }
    }
}
