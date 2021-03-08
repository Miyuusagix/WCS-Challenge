<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrewController extends AbstractController
{
    /**
     * @Route("/crew", name="crew")
     */
    public function index(): Response
    {
        return $this->render('crew/index.html.twig', [
            'controller_name' => 'CrewController',
        ]);
    }
}
