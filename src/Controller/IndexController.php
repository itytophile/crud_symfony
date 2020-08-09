<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $tables = ['auteur', 'oeuvre', 'prixauteur', 'prixoeuvre'];
        return $this->render('index.twig', ['tables' => $tables]);
    }
}
