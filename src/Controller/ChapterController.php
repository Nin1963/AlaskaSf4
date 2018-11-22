<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ChapterRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChapterController extends AbstractController
{
    /**
     * @var ChapterRepository
     */
    private $repository;

    private $repositoryComment;

    private $em;

    public function __construct(ChapterRepository $repository, CommentRepository $repositoryComment, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->repositoryComment = $repositoryComment;
        $this->em = $em;
    }

    /**
     * @Route("/chapters", name="chapter.index")
     * @return Response
     */
    public function index(): Response
    {
        $chapter = $this->repository->findAll();
        
        return $this->render('chapter/index.html.twig');
    }

    /**
     * @Route("/chapters/{slug}-{id}", name="chapter.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(Chapter $chapter, string $slug, Request $request): Response
    {
        if ($chapter->getSlug() !== $slug) {
            return $this->redirectToRoute('chapter.show', [
                'id' => $chapter ->getId(),
                'slug' => $chapter->getSlug()
            ], 301);
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setChapter($chapter);
            $this->em->persist($comment);
            $this->em->flush();

            $this->addFlash('notice', 'Votre commentaire a bien été ajouté.');

            return $this->redirectToRoute('chapter.show', ['slug' => $chapter->getSlug(), 'id' => $chapter->getId()]);
        }

        // Récupération de la valeur du paramètre signal passé dans l'URL
        $signal = $request->query->get('signal');

        // Mise à jour du paramètre signaled
        if ($signal == true) {
            $idComment = $request->query->get('idComment');

            $signaledComment = $this->repositoryComment->find($idComment);
            $signaledComment->setSignaled(true);
            $this->em->flush();

            $this->addFlash('success', 'Commentaire signalé');
        }

        return $this->render('chapter/show.html.twig', [
            'chapter' => $chapter, 
            'form' => $form->createView(),
        ]);
    }
}