<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Form\PrestationsType;
use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prestations")
 */
class PrestationsController extends AbstractController
{
    
    /**
     * @Route("/{id}", name="details", methods={"GET,"POST"})
     */
    public function detailsPrestation(Prestations $prestation): Response
    {
        return $this->render('prestations/details.html.twig',
        [
            'prestation' => $prestation,
        ]);
    }
/**
     * @Route("/new", name="prestations_new", methods={"GET","POST"})
     */
    public function newPrestation(Request $request): Response
    {
        $prestation = new Prestations();
        $form = $this->createForm(PrestationsType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if($imageFile) // si $imageFile n'est pas vide/null ==> une image a été upload
                {
                    
                    $nomImage = date("YmdHis") . "-" . uniqid() . "-" . $imageFile->getClientOriginalName();
                    $imageFile->move(
                        $this->getParameter("image_prestation"),
                        $nomImage
                    );
                    $prestation->setImage($nomImage);
                }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();

            return $this->redirectToRoute('prestations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestations/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="prestations_show", methods={"GET"})
     */
    public function showPrestation(Prestations $prestation): Response
    {
        return $this->render('prestations/show.html.twig',
         [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prestations_edit", methods={"GET","POST"})
     */
    public function editPresattion(Request $request, Prestations $prestation): Response
    {
        $form = $this->createForm(PrestationsType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prestations/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="prestations_delete", methods={"POST"})
     */
    public function deletePrestation(Request $request, Prestations $prestation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prestation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prestations_index', [], Response::HTTP_SEE_OTHER);
    }
    

}
