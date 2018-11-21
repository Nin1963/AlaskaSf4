<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    /**
     * @var CommentRepository
     */
    private $repository;

    public function __construct(CommentRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function index()
    {
        $comments = $this->repository->findAll();

        return $this->render('chapter/show.html.twig', [
            compact('comments')
        ]);
    }

    /**
     * @Route("chapter/{id}", name="comment.new")
     */
    //public function new(Request $request)
    //{
        //$comment = new Comment();
        //$form = $this->createForm(CommentType::class, $comment);
        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
            //$this->em->persist($comment);
            //$this->em->flush();
            //return $this->redirectToRoute('chapter.show');
        //}

        //return $this->render('chapter/show.html.twig', [
            //'comment' => $comment,
            //'form' => $form->createView()
        //]);
    //}
}