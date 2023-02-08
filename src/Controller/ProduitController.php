<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produit_index')]
    public function index(ProduitRepository $prodRepo): Response
    {
        //recuperer les produits
        $produits=$prodRepo->findAll();

        //appel de la vue qui affiche les produits
        
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }



    #[Route('/produit/new', name: 'blog_new_prod')]
    #[Route('/produit/edit/{id}', name: 'blog_edit_prod')]
    public function addProduit(Produit $produit=null,Request $req, EntityManagerInterface $em): Response
    {
        if(!$produit){
        $produit=new Produit();
        }

        //creation Formulaire
        $form=$this->createForm(ProduitType::class,$produit);
         //traitement du retour du formulaire
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid()){
        $em->persist($produit);
        $em->flush();
        return $this->redirectToRoute('produit_index');
        }
    return $this->render('produit/edit_prod.html.twig',[
        'prodForm'=> $form->createView(),
        'mode'=>$produit->getId() != null,
    ]);

    }
}