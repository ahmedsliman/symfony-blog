<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        //return new Response('<h1>Welcome Symfony!</h1>');
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/custom/{name}", name="custom")
     */
    public function custom(Request $request)
    {
        //return new Response("<h1>Welcome {$request->get('name')}!</h1>");
        return $this->render('home/custom.html.twig', ['name' => $request->get('name')]);
    }
}