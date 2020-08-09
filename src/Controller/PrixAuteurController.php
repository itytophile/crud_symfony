<?php

namespace App\Controller;

use App\Entity\PrixAuteur;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\PrixAuteurType;

class PrixAuteurController extends AbstractController
{
    /**
     * @Route("/prixauteur", name="prixauteur")
     */
    public function index()
    {
        $prix = $this->getDoctrine()->getRepository(PrixAuteur::class)->findAll();
        $entities = [];
        foreach ($prix  as $p) {
            $entities[] = [
                'id' => $p->getIdPrixAuteur(),
                'nom' => $p->getNomPrixAuteur()
            ];
        }
        return $this->render('entities.twig', ['entities' => $entities, 'table' => 'prixauteur']);
    }


    /**
     * @Route("/prixauteur/insert")
     */
    public function createPrixAuteur(Request $req)
    {
        $prix = new PrixAuteur();


        $form = $this->createForm(PrixAuteurType::class, $prix);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prix);
            $entityManager->flush();
            return $this->redirectToRoute('showprixauteur', ['id' => $prix->getIdPrixAuteur()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => false
        ]);
    }
    /**
     * @Route("/prixauteur/{id}",name="showprixauteur")
     */
    public function show($id)
    {
        $prix = $this->getDoctrine()
            ->getRepository(PrixAuteur::class)
            ->find($id);

        if (!$prix) {
            throw $this->createNotFoundException(
                'No prix auteur found for id ' . $id
            );
        }

        return $this->render('prixauteur/detail.html.twig', [
            'nom' => $prix->getNomPrixAuteur(),
            'id' => $prix->getIdPrixAuteur(),
            'auteurs' => $prix->getIdAuteur()
        ]);
    }





    /**
     * @Route("/prixauteur/update/{id}")
     */
    public function update($id, Request $req)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $prix = $entityManager->getRepository(PrixAuteur::class)->find($id);

        if (!$prix) {
            throw $this->createNotFoundException(
                'No prix auteur found for id ' . $id
            );
        }

        $form = $this->createForm(PrixAuteurType::class, $prix);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prix);
            $entityManager->flush();
            return $this->redirectToRoute('showprixauteur', ['id' => $prix->getIdPrixAuteur()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => true
        ]);
    }


    /**
     * @Route("/prixauteur/delete/{id}")
     */
    public function delete($id)
    {
        $prix_auteur = $this->getDoctrine()
            ->getRepository(PrixAuteur::class)
            ->find($id);

        if (!$prix_auteur) {
            throw $this->createNotFoundException(
                'No prix_auteur found for id ' . $id
            );
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($prix_auteur);
        $entityManager->flush();

        return $this->redirectToRoute('prixauteur');
    }
}
