<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoginController extends AbstractController
{
    private $githubId;

    public function __construct($githubId)
    {
        $this->githubId = $githubId;
    }

    /**
     * @Route("/login", name="login")
     */
    public function index()
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    /**
     * @Route("/login/github", name="github")
     */
    public function github(UrlGeneratorInterface $generator)
    {
        $url = $generator->generate("dashboard", [], UrlGeneratorInterface::ABSOLUTE_URL); //Redirige vers l'url dashboard
        return new RedirectResponse("https://github.com/login/oauth/authorize?client_id=$this->githubId&redirect_uri=".$url);
    }

    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Une erreur est survenue, veuillez actualiser');
    }

}
