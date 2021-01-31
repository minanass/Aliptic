<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\GridService;

class AdminController extends AbstractController
{
    protected $gridService;

    public function __construct(GridService $gridService)
    {
		$this->gridService = $gridService;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
    	if (!$this->isGranted('ROLE_Admin')) {
    		return $this->redirectToRoute('home');
    	}
    	

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/new_grid", name="new_grid", methods={"POST"})
     */
    public function newGrid(Request $request): Response
    {
        $data = $request->request->all();
        $submittedToken = array_shift($data);

        if ($this->isCsrfTokenValid('new-grid', $submittedToken)) 
        {
            $this->gridService->createGrid($data);
            $this->addFlash('creationGrid',"Vous vennez de créer, une nouvelle grille" );
        }

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
