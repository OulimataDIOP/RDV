<?php

namespace App\Controller;

use App\Repository\CreneauRepository;
use App\Repository\PrestationsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig');
    }
    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        return $this->render('test-index.html.twig');
    }
    /**
     * @Route("/rdv", name="rdv")
     */
    public function rdvFront(CreneauRepository $creneauxRepository): Response{
        return $this->render('front/rdv.html.twig', [
            'creneaux' => $creneauxRepository->findAll(),
        ]);
    }
    /**
     * @Route("/prestations", name="prestations_index", methods={"GET"})
     */
    public function prestationsFront(PrestationsRepository $prestationsRepository): Response
    {
        return $this->render('front/prestations.html.twig', [
            'prestations' => $prestationsRepository->findAll(),
        ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contactFront(): Response
    {
        return $this->render('front/contact.html.twig');
    }
    
    /**
     * @Route("/logout/{role}", name="deconnexion")
     */
    public function deconnexion($role)
    {
            //démarrer la session
            $session = new Session;
            $session->clear();
            if($role == 'client'){
                return $this->redirectToRoute(('authentification'));
            }else if($role == 'admin'){
                return $this->redirectToRoute(('gestion'));
            }
        
    }
    
}
