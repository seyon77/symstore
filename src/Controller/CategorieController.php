<?php

namespace App\Controller;


use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'categorie_index')]
    public function index(CategorieRepository $catRepo): Response
    {
        $categories=$catRepo->findAll();
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
