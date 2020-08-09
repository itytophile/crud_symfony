<?php

namespace App\Controller;

use App\Entity\Auteur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\AuteurType;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="auteur")
     */
    public function index()
    {
        $auteurs = $this->getDoctrine()->getRepository(Auteur::class)->findAll();
        $entities = [];
        foreach ($auteurs as $auteur) {
            $entities[] = [
                'id' => $auteur->getIdAuteur(),
                'nom' => $auteur->getNomAuteur(),
                'prenom' => $auteur->getPrenomAuteur()
            ];
        }
        return $this->render('entities.twig', ['entities' => $entities, 'table' => 'auteur']);
    }

    /**
     * @Route("/auteur/insert")
     */
    public function createAuteur(Request $req)
    {
        $auteur = new Auteur();


        $form = $this->createForm(AuteurType::class, $auteur);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();
            return $this->redirectToRoute('show', ['id' => $auteur->getIdAuteur()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => false
        ]);
    }

    /**
     * @Route("/auteur/{id}",name="show")
     */
    public function show($id)
    {
        $auteur = $this->getDoctrine()
            ->getRepository(Auteur::class)
            ->find($id);

        if (!$auteur) {
            throw $this->createNotFoundException(
                'No auteur found for id ' . $id
            );
        }
        $entity = [
            'nom' => $auteur->getNomAuteur(),
            'prenom' => $auteur->getPrenomAuteur()
        ];

        return $this->render('auteur/detail.html.twig', ['entity' => $entity, 'oeuvres' => $auteur->getIdOeuvre(), 'prix' => $auteur->getIdPrixAuteur(), 'id' => $auteur->getIdAuteur(), 'table' => 'auteur']);
    }


    /**
     * @Route("/auteur/update/{id}")
     */
    public function update($id, Request $req)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $auteur = $entityManager->getRepository(Auteur::class)->find($id);

        if (!$auteur) {
            throw $this->createNotFoundException(
                'No auteur found for id ' . $id
            );
        }

        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('show', ['id' => $auteur->getIdAuteur()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => true
        ]);
    }


    /**
     * @Route("/auteur/delete/{id}")
     */
    public function delete($id)
    {
        $auteur = $this->getDoctrine()
            ->getRepository(Auteur::class)
            ->find($id);

        if (!$auteur) {
            throw $this->createNotFoundException(
                'No auteur found for id ' . $id
            );
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($auteur);
        $entityManager->flush();

        return $this->redirectToRoute('auteur');
    }
}
