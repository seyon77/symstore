<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProdFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Pour utiliser Faker
        $faker=Factory::create('fr_FR');
        for($j=0;$j<4;$j++){
            $cat=new Categorie;
            $cat->setNom($faker->word());
            $cat->setDescription($faker->paragraph(3,true));
            $manager->persist($cat);

        
        //generation produit 
        for($i=0;$i<5;$i++){
            $prod=new Produit();
            $prod->setNom($faker->word());
            $prod->setDescription($faker->paragraph(3,true));
            $prod->setPrix($faker->randomNumber(2));  
            $prod->setCategorie($cat);     
            $manager->persist($prod);
        }
    }   
        $manager->flush();
    }
}
