<?php

namespace App\Controller;

use App\Repository\ChapterRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    
    public function index(ChapterRepository $repository): Response
    {
        $chapters = $repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'chapters' => $chapters
        ]);
    }

}