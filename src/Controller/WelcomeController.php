<?php

namespace App\Controller;

// On "use" une classe spécifique de Symfony
// La classe Response est rangée dans le namespace
// Symfony\Component\HttpFoundation

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * Le @ est une annotation qui permet de définir la méthode qui
     * suit en tant que page de l'application Symfony.
     * @Route ("/bonjour", name="hello")
     */
    public function hello()
    {
        $name = 'John';

        // return new Response('<body>'. $name .'</body>');
        return $this->render('welcome/hello.html.twig', [
            'name' => $name,
            'lastname' => "Doe"
        ]);
    }
}