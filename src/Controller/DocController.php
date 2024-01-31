<?php

namespace App\Controller;

use App\Repository\LevelRepository;
use App\Repository\SubjectRepository;
use App\Repository\ThemeRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocController extends AbstractController
{
    #[Route('/chercher-un-document', name: 'doc_search')]
    public function searchDocs(TypeRepository $typeRepository, LevelRepository $levelRepository, SubjectRepository $subjectRepository, ThemeRepository $themeRepository): Response
    {
        $types = $typeRepository->findAll();
        $levels = $levelRepository->findAll();
        $subjects = $subjectRepository->findAll();
        $themes = $themeRepository->findAll();
        return $this->render('doc/search.html.twig', [
            'types' => $types,
            'levels' => $levels,
            'subjects' => $subjects,
            'themes' => $themes,
        ]);
    }
}
