<?php 

namespace App\Controller\Admin;

use App\Entity\Chapter;
use App\Form\ChapterType;
use App\Repository\ChapterRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminChapterController extends AbstractController
{
    /**
     * @var ChapterRepository
     */
    private $repository;

    public function __construct(ChapterRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/admin", name="admin.chapter.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $chapters = $this-> repository->findAll();
        
        return $this->render('admin/chapter/index.html.twig', compact('chapters'));
    }

    /**
     * @Route("/admin/chapter/create", name="admin.chapter.new")
     */
    public function new(Request $request) 
    {
        $chapter = new Chapter();
        
        $form = $this-> createForm(ChapterType::class, $chapter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($chapter);
            $this->em->flush();
            $this->addFlash('success', 'Le nouveau chapitre a bien été créé!');
            return $this->redirectToRoute('admin.chapter.index');
        }

        return $this->render    ('admin/chapter/new.html.twig', [
            'chapter' => $chapter,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/chapter/{id}", name="admin.chapter.edit", methods="GET|POST")
     */
    public function edit(Chapter $chapter, Request $request)
    {
        $form = $this-> createForm(ChapterType::class, $chapter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Le chapitre a bien été modifié!');
            return $this->redirectToRoute('admin.chapter.index');
        }

        return $this->render('admin/chapter/edit.html.twig', [
            'chapter' => $chapter,
            'form' => $form->createView()
        ]);
    }

    /**
     *@Route("/admin/chapter/{id}", name= "admin.chapter.delete", methods="DELETE")
     */
    public function delete(Chapter $chapter, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $chapter->getId(), $request->get('_token'))) {
            $this->em->remove($chapter);
            $this->em->flush();
            $this->addFlash('success', 'Le chapitre a bien été supprimé!');
        }

        return $this->redirectToRoute('admin.chapter.index');
    }
        
}