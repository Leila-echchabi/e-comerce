<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{

const PRODUCTS = '[
{"name": "Alistair", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum lorem ilpsum ", "price": "129", "image": "Img-Boutique-e-commerce/imgBoutique1.jpg", "qty":"1" },
{"name": "Ignatus", "description": "Praesentium error asperiores totam unde tempora. Ducimus, facilis tenetur ", "price": "129", "image": "Img-Boutique-e-commerce/imgBoutique2.jpg", "qty":"1" },
{"name": "Kabéna", "description": "corrupti maiores illum hic nesciunt adipisci, veniam dolorum repellendus.", "price": "129", "image": "Img-Boutique-e-commerce/imgBoutique3.jpg", "qty":"1" },
{"name": "Linéance", "description": "Voluptate ad vero quisquam perferendis eligendi exercitationem excepturi", "price": "129", "image": "Img-Boutique-e-commerce/imgBoutique4.jpg", "qty":"1" },
{"name": "Macoumi", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "129", "image": "Img-Boutique-e-commerce/imgBoutique5.jpg", "qty":"1" },
{"name": "Justine", "description": " voluptates dolorem optio magni neque culpa quam cupiditate", "price": "129", "image": "Img-Boutique-e-commerce/imgBoutique6.jpg", "qty":"1" },
{"name": "Oswald", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "129", "image": "Img-Boutique-e-commerce/imgBoutique7.jpg", "qty":"1" }
]';

    public function load(ObjectManager $manager)
    {
    $products = json_decode(self::PRODUCTS, true);
    foreach ($products as $product){
        $watch = new Product();
        $r=random_int(0, count(CategoryFixtures::CATEGORIES)-1);


        $watch->setName($product['name']);
        $watch->setDescription($product["description"]);
        $watch->setPrice($product["price"]);
        $watch->setReference(substr(str_shuffle(md5(random_int(0, 1000000))), 0, 25));
        $watch->setImage($product["image"]);
        $watch->setQuantity($product["qty"]);
        $watch->setCategory($this->getReference('category_'.$r));


        $manager->persist($watch);
    }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
