<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RegistrationFormType;
use App\Repository\RankingRepository;
use App\Entity\User;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RankingRepository $rankingRepo, Request $request): Response
    {
        $user = new User;
        $form = $this->createForm(RegistrationFormType::class, $user, [
            'action' => $this->generateUrl('app_register'),
        ]);


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'ranking' => $rankingRepo->findFirstTenUserOderByScore(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/legales_mentions", name="legales_mentions")
     * @return Response
     */
    public function showLegalesMention(): Response
    {
        return $this->render('pages/legales_mentions.html.twig');
    }

    /**
     * @Route(path="/rules", name="rules")
     * @return Response
     */
    public function showGameRules(): Response
    {
        return $this->render('pages/game_rules.html.twig');
    }

    /**
     * @Route(path="/group_description", name="group_description")
     * @return Response
     */
    public function showGroupDescription(): Response
    {
        return $this->render('pages/group_description.html.twig');
    }

}
