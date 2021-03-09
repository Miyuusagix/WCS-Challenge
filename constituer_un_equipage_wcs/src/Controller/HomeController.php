<?php

namespace App\Controller;

use App\Entity\Crew;
use App\Form\CrewType;
use App\Repository\CrewRepository;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Affichage liste de l'équipage
     * 
     * @Route("/home", name="home")
     */
    public function index(CrewRepository $crewRepository): Response
    {
        // Tous les membres de l'équipage
        $crew = $crewRepository->findAll();

        return $this->render('home/index.html.twig', [
            'crew' => $crew
            // 'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Enregistrer un nouvel équipier en BDD
     * 
     * @Route("/add", name="home")
     */
    public function create(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
//         $crew = new Crew();
//         $form = $this->createFormBuilder($crew)
//             ->add(’name’)
//             ->getForm();
// return $this->render(’personne/add.html.twig’, [
// ’controller_name’ => ’PersonneController’,
// ’form’ => $form->createView(),
// ]);

        $crew = new Crew;

        $form = $this->createForm(CrewType::class, $crew);

        //le form gere la requete
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Note: on a délégué la gestion du slug au Listener

            $entityManagerInterface->persist($crew);
    
            $entityManagerInterface->flush();

            $this->addFlash('success', 'Membre ajouté !');
        }

        return $this->render('home/index.html.twig', [
            // 'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Create crew
     * 
     * @Route("/crew/create", name="crew_post", methods="POST")
     */
    public function post(Request $request, SerializerInterface $serializer)
    {
        // Le JSON du body
        $jsonContent = $request->getContent();
        
        // Deserialization du JSON
        $crew = $serializer->deserialize($jsonContent, Crew::class, 'json');

        return $this->render('home/index.html.twig');

        // dd($crew);
    }

}
