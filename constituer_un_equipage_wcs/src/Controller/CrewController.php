<?php

namespace App\Controller;

use App\Repository\CrewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrewController extends AbstractController
{
    /**
     * @Route("/crew", name="crew", methods={"POST","PUT","PATCH"})
     */
    public function index(): Response
    {
        return $this->render('crew/index.html.twig', [
            'controller_name' => 'CrewController',
        ]);
    }

    /**
     * @Route("/crew/list", name="crew")
     */
    public function Crewlist(CrewRepository $crewRepository): Response
    {
        $crewM = $crewRepository->findAll();

        return $this->json($crewM, Response::HTTP_OK, [], []);
    }


}
