<?php

namespace App\Controller;

use App\Entity\DocSearch;
use App\Form\DocSearchType;
use App\Repository\DocumentRepository;
use App\Repository\TypeRepository;
use App\Repository\LevelRepository;
use App\Repository\ThemeRepository;
use App\Repository\SubjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DocController extends AbstractController
{
    #[Route('/chercher-un-document', name: 'doc_search')]
    public function searchDocs(Request $request, DocumentRepository $documentRepository): Response
    {
        $docSearch = new DocSearch();
        $form = $this->createForm(DocSearchType::class, $docSearch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $docSearch = $form->getData();
            $documents = $documentRepository->findBySearchCriteria($docSearch);
            dump($documents);

            // return $this->render('doc/results.html.twig', [
            //     'documents' => $documents,
            // ]);
        }

        return $this->render('doc/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/chercher-un-document/{id}', name: 'doc_show')]
    public function showDoc(TypeRepository $typeRepository, LevelRepository $levelRepository, SubjectRepository $subjectRepository, ThemeRepository $themeRepository): Response
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
