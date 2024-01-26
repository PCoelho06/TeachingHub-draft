<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/à-propos', name: 'app_about')]
    public function showAbout(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/nous-contacter', name: 'app_contact')]
    public function showContact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/mentions-legales', name: 'app_legal_mentions')]
    public function showLegalMentions(): Response
    {
        return $this->render('home/legal-mentions.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/politique-accessibilité', name: 'app_accessibility')]
    public function showAccessibility(): Response
    {
        return $this->render('home/accessibility.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/politique-confidentialité', name: 'app_confidentiality')]
    public function showConfidentiality(): Response
    {
        return $this->render('home/confidentiality.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
