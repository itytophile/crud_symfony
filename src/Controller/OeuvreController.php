<?php

namespace App\Controller;

use App\Entity\Oeuvre;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\OeuvreType;

class OeuvreController extends AbstractController
{
    /**
     * @Route("/oeuvre",name="oeuvre")
     */
    public function index()
    {
        $oeuvres = $this->getDoctrine()->getRepository(Oeuvre::class)->findAll();
        $entities = [];
        foreach ($oeuvres as $oeuvre) {
            $entities[] = [
                'id' => $oeuvre->getIdOeuvre(),
                'nom' => $oeuvre->getNomOeuvre()
            ];
        }
        return $this->render('entities.twig', ['entities' => $entities, 'table' => 'oeuvre']);
    }



    /**
     * @Route("/oeuvre/insert/")
     */
    public function createOeuvre(Request $req)
    {
        $oeuvre = new Oeuvre();
        $form = $this->createForm(OeuvreType::class, $oeuvre);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oeuvre);
            $entityManager->flush();
            return $this->redirectToRoute('showOeuvre', ['id' => $oeuvre->getIdOeuvre()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => false
        ]);
    }


    /**
     * @Route("/oeuvre/{id}",name="showOeuvre")
     */
    public function show($id)
    {
        $oeuvre = $this->getDoctrine()
            ->getRepository(Oeuvre::class)
            ->find($id);

        if (!$oeuvre) {
            return $this->redirectToRoute('oeuvre');
        }

        return $this->render('oeuvre/detail.html.twig', [
            'id' => $oeuvre->getIdOeuvre(),
            'nom' => $oeuvre->getNomOeuvre(),
            'prix' => $oeuvre->getIdPrixOeuvre(),
            'auteurs' => $oeuvre->getIdAuteur()
        ]);
    }





    /**
     * @Route("/oeuvre/update/{id}")
     */
    public function update($id, Request $req)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $oeuvre = $entityManager->getRepository(Oeuvre::class)->find($id);

        if (!$oeuvre) {
            throw $this->createNotFoundException(
                'No oeuvre found for id ' . $id
            );
        }


        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($oeuvre);
            $entityManager->flush();
            return $this->redirectToRoute('showOeuvre', ['id' => $oeuvre->getIdOeuvre()]);
        }
        return $this->render('form.twig', [
            'form' => $form->createView(),
            'editMode' => true
        ]);
    }


    /**
     * @Route("/oeuvre/delete/{id}")
     */
    public function delete($id)
    {
        $oeuvre = $this->getDoctrine()
            ->getRepository(Oeuvre::class)
            ->find($id);

        if (!$oeuvre) {
            throw $this->createNotFoundException(
                'No oeuvre found for id ' . $id
            );
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($oeuvre);
        $entityManager->flush();

        return $this->redirectToRoute('oeuvre');
    }
}
