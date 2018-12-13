<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\BiensRepository;

class HomeController extends AbstractController

{

    public function index(BiensRepository $repository)
    {
        $bien = $repository->findDernier();
        return $this->render('pages/home.html.twig', [
            'biens' => $bien
        ]) ;
    }
}


?> 