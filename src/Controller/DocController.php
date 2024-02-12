<?php

namespace App\Controller;

use App\Form\DocType;
use DateTimeImmutable;
use App\Entity\Document;
use App\Entity\DocSearch;
use App\Form\DocSearchType;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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

            return $this->render('doc/results.html.twig', [
                'documents' => $documents,
            ]);
        }

        return $this->render('doc/search.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deposer-un-document', name: 'doc_add')]
    public function addDoc(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $doc = new Document();

        $form = $this->createForm(DocType::class, $doc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doc = $form->getData();
            $file = $form->get('file')->getData();

            $slug = $slugger->slug($doc->getTitle() . ' ' . uniqid());
            $filename = $slug . '.' . $file->guessExtension();

            try {
                $file->move(
                    $this->getParameter('documents_directory'),
                    $filename
                );
            } catch (FileException $e) {
                $this->addFlash(
                    'danger',
                    'Votre document n\'a pas pu être téléchargé. Si le problème persiste, merci de nous contacter.'
                );
                return $this->redirect('doc_add');
            }

            $doc->setCreatedAt(new DateTimeImmutable())
                ->setSlug($slug)
                ->setFilename($filename);

            $manager->persist($doc);
            $manager->flush();

            return $this->redirectToRoute('doc_show', ['slug' => $slug]);
        }

        return $this->render('doc/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/documents/{slug}', name: 'doc_show')]
    public function showDoc(Document $document): Response
    {
        return $this->render('doc/show.html.twig', [
            'document' => $document,
        ]);
    }
}
