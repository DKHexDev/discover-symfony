<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/discover", name="demo_list")
     */
    public function list()
    {
        return $this->render('demo/list.html.twig', [
            'page' => 'page 1',
            'cars' => [
                ['brand' => "Renault"],
                ['brand' => "Peugeot"],
                ['brand' => "Citroen"],
            ]
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

    /**
     * @Route("/discover/create", name="demo_create")
     */
    public function create(Request $request)
    {
        // Avec symfony, on n'utilise plus $_GET ou $_POST
        // On va utiliser un objet request
        //dump($request);
        // Equivalent de $_GET['post'] ?? null
        //dump($request->query->get('page'));
        //dump($request->get('page')); // Raccourci

        // Equivalent de $_POST['message'] ?? null
        // dump($request->request->get('message'));
        // dump($request->get('message'));

        if($request->get('message') === 'secret')
        {
            $this->addFlash('success', 'Le message a été envoyé');
            // return $this->redirect('https://google.fr');
            return $this->redirectToRoute('demo_list');
        }

        return $this->render('demo/create.html.twig', [
            'message' => $request->get('message'),
        ]);
    }
}
