<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route("/demo", name="demo")
     */
    public function index(): Response
    {
        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
        ]);
    }

    

    /**
     * @Route("/demo/{title}", name="demo_show")
     */
    public function show($title)
    {
        return $this->render('demo/show.html.twig', [
            'title' => $title,
        ]);
    }
}
