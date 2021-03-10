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
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

     /**
     * Affichage liste de l'équipage & ajout des nouveaux membres en BDD
     *
     * @Route("/home", name="home", methods={"GET", "POST"})
     */
    public function index(Request $request, CrewRepository $crewRepository)
    {
        // Nouvelle entité Crew
        $crew = new Crew();

        // Form basé sur CrewType et l'entité Crew
        $form = $this->createForm(CrewType::class, $crew);

        // Prise en charge de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On stocke le l'équipier en base
            $em = $this->getDoctrine()->getManager();
            // Le $crew a été déjà mis à jour par le form
            $em->persist($crew);
            $em->flush();

            // Flash
            $this->addFlash('success', 'Crew ajouté.');
        }

        // Select all crews ordered by name ASC
        $crew = $crewRepository->findBy([], ['name' => 'ASC']);

        // On affiche le form
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'crew' => $crew,
        ]);
    }


    /**
     * Affichage liste de l'équipage
     * 
     * @Route("/home", name="home")
     */
    /*
    public function index(CrewRepository $crewRepository): Response
    {
        // Tous les membres de l'équipage
        $crew = $crewRepository->findAll();

        return $this->render('home/index.html.twig', [
            'crew' => $crew
            // 'controller_name' => 'HomeController',
        ]);
    }
    */



    /**
     * Enregistrer un nouvel équipier en BDD
     * 
     * @Route("/add", name="add")
     */
    // public function create(EntityManagerInterface $entityManagerInterface, Request $request): Response
    // {
//         $crew = new Crew();
//         $form = $this->createFormBuilder($crew)
//             ->add(’name’)
//             ->getForm();
// return $this->render(’personne/add.html.twig’, [
// ’controller_name’ => ’PersonneController’,
// ’form’ => $form->createView(),
// ]);

    //     $crew = new Crew;

    //     $form = $this->createForm(CrewType::class, $crew);

    //     //le form gere la requete
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         // Note: on a délégué la gestion du slug au Listener

    //         $entityManagerInterface->persist($crew);
    
    //         $entityManagerInterface->flush();

    //         $this->addFlash('success', 'Membre ajouté !');
    //     }

    //     return $this->render('home/index.html.twig', [
    //         // 'controller_name' => 'HomeController',
    //     ]);
    // }

   

   /**
     * Méthode qui permet un équipier en BDD
     * 
     * @Route("/new/crew", name="newcrew", methods={"POST","PUT","PATCH"})
     */

//    public function newCrew( Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $entityManagerInterface): Response
//    {
       
//        $jsonContent = $request->getContent();
       
//        $newCrew = $serializer->deserialize($jsonContent, Crew::class, 'json' );
      
//        $errors = $validator->validate($newCrew);

//        // Si nombre d'erreur > 0 alors on renvoie une erreur
//        if (count($errors) > 0) {
//            // On retourne le tableau d'erreurs en Json au front 
//            return $this->json('ça ne fonctionne pas', Response::HTTP_UNPROCESSABLE_ENTITY);
//        }

//        $entityManagerInterface->persist($newCrew);

//        $entityManagerInterface->flush();

//        $this->addFlash('success', 'Membre ajouté !');

//     //    return $this->json(['message' => 'L\'équipier a été créé'], Response::HTTP_CREATED);

//        return $this->render('home/index.html.twig');

//    }


//    /**
//      * Ajouter un équipier
//      *
//      * @Route("/crew/add", name="crew_add", methods={"GET", "POST"})
//      */
//     public function add(Request $request)
//     {
//         // Nouvelle entité Job
//         $crew = new Crew();

//         // Form basé sur JobType et l'entité Job
//         $form = $this->createForm(CrewType::class, $crew);

//         // Prise en charge de la requête
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             // On stocke le job en base
//             $em = $this->getDoctrine()->getManager();
//             // Le $job a été déjà mis à jour par le form
//             $em->persist($crew);
//             $em->flush();

//             // Flash
//             $this->addFlash('success', 'équipier ajouté.');

//             // // Retour vers la liste des Jobs
//             // return $this->redirectToRoute('back_job_show', ['id' => $job->getId()]);
//         }

//         // On affiche le form
//         return $this->render('home/index.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }

}
