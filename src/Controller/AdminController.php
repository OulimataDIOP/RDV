<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\RdvType;
use App\Entity\Prestations;
use App\Form\PrestationsType;
use App\Repository\RdvRepository;
use App\Repository\CreneauRepository;
use App\Repository\PrestationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="homeAdmin")
     */
    public function index(): Response
    {
        return $this->render('admin/homeAdmin.html.twig');
    }
    /**
     * @Route("/admin_prestations", name="admin_prestations")
     */
    public function prestationsAdmin(PrestationsRepository $prestationsRepository): Response
    {
        return $this->render('admin/prestationsAdmin.html.twig', [
            'prestations' => $prestationsRepository->findAll()
        ]);
    }
     /**
     * @Route("/admin_creneaux", name="admin_creneaux")
     */
    public function creneauAdmin(CreneauRepository $creneauxRepository): Response
    {
        return $this->render('admin/creneauxAdmin.html.twig', [
            'prestations' => $creneauxRepository->findAll()
        ]);
    }
/**
     * @Route("/gestion", name="admin")
     */
    public function login(Request $req): Response
    {
        if($req->isMethod('POST'))
        {
            $email=$req->get('email');$pwd=$req->get('mdp');
            if($email=='admin2021@gmail.com' and $pwd='admin123')
            {
            $session = new Session();
            $session->set('role','admin');
            return $this->redirectToRoute('homeAdmin');}
            else {
                $erreur="Vous n'êtes pas l'admin !!!";
            }
        }

        return $this->render('admin/login.html.twig',array('error'=>@$erreur));
    }

}
