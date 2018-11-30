<?php
namespace App\Controller;


use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ChapterRepository;
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
    private $repositoryComment;
    private $em;

    public function __construct(ChapterRepository $repository, CommentRepository $repositoryComment, EntityManagerInterface $em)
    {
        $this->repositoryComment = $repositoryComment;
        $this->em = $em;
    }

    public function index()
    {
        $comments = $this->repositoryComment->findAll();

        return $this->render('chapter/show.html.twig', [
            compact('comments')
        ]);
    }

     /**
     * @Route("/admin/signaled", name="comment.signal")
    */ 
    public function signaled() 
    {
        $comments = $this->repositoryComment->findSignaledQuery();

        return $this->render('admin/comment/signaled.html.twig', [
            'comments' => $comments
        ]);
    }

    /**
     * 
     */
    //public function  deleteComment()
    //{
       // return $this->render('admin/comment/signaled.html.twig', [
          //  'comments' => $comments
        //]);
    //}

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