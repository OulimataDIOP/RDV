<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientType;
use App\Repository\ClientsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientsController extends AbstractController
{
   /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $req, ClientsRepository $select)
    {
        $clt = new Clients();
        $form=$this->createForm(ClientType::class,$clt);
        $form->handleRequest($req);
        if($req->isMethod('POST')){
            
            $frm = $req->get('client');
            $email = $frm['email'];
            $res= $select->findOneBy(array('email'=>$email));
            if(!empty($res)){
                $error = 'Cette adresse mail à déja été utilisée';
            }else{
                $cnx = $this->getDoctrine()->getManager();
            $cnx->persist($clt);
            $cnx->flush();
            return $this->redirectToRoute(('home'));
            }
            
            //Connexion avec doctrine
            
        }
        return $this->render('clients/inscription.html.twig', [
            'form' =>$form->createView(),
            'msg'=>@$error,
            
        ]);
    }
    /**
     * @Route("/connexion", name="loginClient")
     */
    public function authentification(Request $request, ClientsRepository $select){
        $form =$this->createForm(ClientType::class);
        if($request->isMethod('POST'))
        {
            $frm = $request->get('client');
            $email = $frm['email'];
            $mdp = $frm['mdp'];
            // echo '<h1> Email '.$email.' Password '.$mdp.' </h1>';
            // return new Response($email .' '.$mdp);
            // SELECT FROM CLIENTS MAIL AND PASSWORD
            $res= $select->findOneBy(array('email'=>$email));
            if(empty($res)){
                $message = 'Cette adresse mail n\'est pas enregistré';
            }
            else{
                $password=$res->getMdp();
                if($password ==$mdp){
                    //démarrer la session
                    $session = new Session;
                    // création de la session
                    $session->set('client',$res);
                    $session->set('role','client');
                    // Redirection vers la page d'afficchage
                    return $this->redirectToRoute('home');
                    $message = 'Bienvenue' .$res->getPrenom();
                }
                else{
                    $message = 'Mot de passe incorrect';
                }
            }
        }
        return $this->render('clients/connexion.html.twig',[
            'form'=>$form->createView(),
            'msg'=>@$message,
        ]);
    }
}