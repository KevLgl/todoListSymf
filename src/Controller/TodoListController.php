<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */

class TodoListController extends AbstractController
{
    
    /**
     * @Route("/", name="index")
     * @Route("/todolist", name="todolist")
     */
    public function index(): Response
    {
        return $this->render('todo_list/index.html.twig', [
            'controller_name' => 'TodoListController',
        ]);
    }

    /**
     * @Route("/backed", name="backed_projects", methods={"GET"})
     */
    public function backedProjects(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findBy(
            ['status' => 'bebacked'],
        );

        return $this->render('project/backedProject.html.twig', [
            'projects' => $projects
        ]);
    }


}
