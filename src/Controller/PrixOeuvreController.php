<?php

namespace App\Controller;

use App\Entity\PrixOeuvre;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\PrixOeuvreType;

class PrixOeuvreController extends AbstractController
{
    /**
     * @Route("/prixoeuvre", name="prixoeuvre")
     */
    public function index()
    {
        $prix = $this->getDoctrine()->getRepository(PrixOeuvre::class)->findAll();
        $entities = [];
        foreach ($prix  as $p) {
            $entities[] = [
                'id' => $p->getIdPrixOeuvre(),
                'nom' => $p->getNomPrixOeuvre()
            ];
        }
        return $this->render('entities.twig', [
            'entities' => $entities,
            'table' => 'prixoeuvre'
        ]);
    }

    /**
     * @Route("/prixoeuvre/insert")
     */
    public function createPrixOeuvre(Request $req)
    {
        $prix = new PrixOeuvre();


        $form = $this->createForm(PrixOeuvreType::class, $prix);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prix);
            $entityManager->flush();
            return $this->redirectToRoute('showprixoeuvre', ['id' => $prix->getIdPrixOeuvre()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => false
        ]);
    }



    /**
     * @Route("/prixoeuvre/{id}",name="showprixoeuvre")
     */
    public function show($id)
    {
        $prix = $this->getDoctrine()
            ->getRepository(PrixOeuvre::class)
            ->find($id);

        if (!$prix) {
            throw $this->createNotFoundException(
                'No prix Oeuvre found for id ' . $id
            );
        }

        return $this->render('prixoeuvre/detail.html.twig', [
            'id' => $prix->getIdPrixOeuvre(),
            'nom' => $prix->getNomPrixOeuvre(),
            'oeuvres' => $prix->getIdOeuvre()
        ]);
    }





    /**
     * @Route("/prixoeuvre/update/{id}")
     */
    public function update($id, Request $req)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $prix = $entityManager->getRepository(PrixOeuvre::class)->find($id);

        if (!$prix) {
            throw $this->createNotFoundException(
                'No prix Oeuvre found for id ' . $id
            );
        }

        $form = $this->createForm(PrixOeuvreType::class, $prix);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prix);
            $entityManager->flush();
            return $this->redirectToRoute('showprixoeuvre', ['id' => $prix->getIdPrixOeuvre()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => true
        ]);
    }


    /**
     * @Route("/prixoeuvre/delete/{id}")
     */
    public function delete($id)
    {
        $prix_oeuvre = $this->getDoctrine()
            ->getRepository(PrixOeuvre::class)
            ->find($id);

        if (!$prix_oeuvre) {
            throw $this->createNotFoundException(
                'No prix_oeuvre found for id ' . $id
            );
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($prix_oeuvre);
        $entityManager->flush();

        return $this->redirectToRoute('prixoeuvre');
    }
}
