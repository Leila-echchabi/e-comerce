<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{

const PRODUCTS = '[
{"name": "Alistair", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum lorem ilpsum ", "price": "1129", "image": "5ee360bcb9205938567094.jpg", "qty":"1" },
{"name": "Ignatus", "description": "Praesentium error asperiores totam unde tempora. Ducimus, facilis tenetur ", "price": "1209", "image": "5ee37974a8392768642140.jpg", "qty":"1" },
{"name": "Kabéna", "description": "corrupti maiores illum hic nesciunt adipisci, veniam dolorum repellendus.", "price": "159", "image": "5ee3798592e38709377481.jpg", "qty":"1" },
{"name": "Linéance", "description": "Voluptate ad vero quisquam perferendis eligendi exercitationem excepturi", "price": "929", "image": "5ee379e0d9bb0752831433.jpg", "qty":"1" },
{"name": "Macoumi", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "169", "image": "5ee37eede82e2715823769.jpg", "qty":"1" },
{"name": "Justine", "description": " voluptates dolorem optio magni neque culpa quam cupiditate", "price": "429", "image": "5ee37f02277dd381584179.jpg", "qty":"1" },
{"name": "Oswald", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "2029", "image": "5ee37f1631254485535614.jpg", "qty":"1" },
{"name": "Alistair", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum lorem ilpsum ", "price": "1129", "image": "5ee360bcb9205938567094.jpg", "qty":"1" },
{"name": "Ignatus", "description": "Praesentium error asperiores totam unde tempora. Ducimus, facilis tenetur ", "price": "209", "image": "5ee37974a8392768642140.jpg", "qty":"1" },
{"name": "Kabéna", "description": "corrupti maiores illum hic nesciunt adipisci, veniam dolorum repellendus.", "price": "459", "image": "5ee3798592e38709377481.jpg", "qty":"1" },
{"name": "Linéance", "description": "Voluptate ad vero quisquam perferendis eligendi exercitationem excepturi", "price": "929", "image": "5ee379e0d9bb0752831433.jpg", "qty":"1" },
{"name": "Macoumi", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "169", "image": "5ee37eede82e2715823769.jpg", "qty":"1" },
{"name": "Justine", "description": " voluptates dolorem optio magni neque culpa quam cupiditate", "price": "729", "image": "5ee37f02277dd381584179.jpg", "qty":"1" },
{"name": "Oswald", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "2029", "image": "5ee37f1631254485535614.jpg", "qty":"1" },
{"name": "Alistair", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum lorem ilpsum ", "price": "1129", "image": "5ee360bcb9205938567094.jpg", "qty":"1" },
{"name": "Ignatus", "description": "Praesentium error asperiores totam unde tempora. Ducimus, facilis tenetur ", "price": "1999", "image": "5ee37974a8392768642140.jpg", "qty":"1" },
{"name": "Kabéna", "description": "corrupti maiores illum hic nesciunt adipisci, veniam dolorum repellendus.", "price": "349", "image": "5ee3798592e38709377481.jpg", "qty":"1" },
{"name": "Linéance", "description": "Voluptate ad vero quisquam perferendis eligendi exercitationem excepturi", "price": "929", "image": "5ee379e0d9bb0752831433.jpg", "qty":"1" },
{"name": "Macoumi", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "969", "image": "5ee37eede82e2715823769.jpg", "qty":"1" },
{"name": "Justine", "description": " voluptates dolorem optio magni neque culpa quam cupiditate", "price": "899", "image": "5ee37f02277dd381584179.jpg", "qty":"1" },
{"name": "Oswald", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "2529", "image": "5ee37f1631254485535614.jpg", "qty":"1" },
{"name": "Alistair", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum lorem ilpsum ", "price": "1129", "image": "5ee360bcb9205938567094.jpg", "qty":"1" },
{"name": "Ignatus", "description": "Praesentium error asperiores totam unde tempora. Ducimus, facilis tenetur ", "price": "209", "image": "5ee37974a8392768642140.jpg", "qty":"1" },
{"name": "Kabéna", "description": "corrupti maiores illum hic nesciunt adipisci, veniam dolorum repellendus.", "price": "459", "image": "5ee3798592e38709377481.jpg", "qty":"1" },
{"name": "Linéance", "description": "Voluptate ad vero quisquam perferendis eligendi exercitationem excepturi", "price": "529", "image": "5ee379e0d9bb0752831433.jpg", "qty":"1" },
{"name": "Macoumi", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "178", "image": "5ee37eede82e2715823769.jpg", "qty":"1" },
{"name": "Justine", "description": " voluptates dolorem optio magni neque culpa quam cupiditate", "price": "829", "image": "5ee37f02277dd381584179.jpg", "qty":"1" },
{"name": "Oswald", "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit.", "price": "1500", "image": "5ee37f1631254485535614.jpg", "qty":"1" }
]';

const BRACELET = [
    'Acier',
    'Or',
    'Titan',
    'Cuire',
    'Céramique',
    'Caoutchouc'
];

    const CASES = [
        'Acier',
        'Or',
        'Titan'
    ];

    public function load(ObjectManager $manager)
    {
    $products = json_decode(self::PRODUCTS, true);
    foreach ($products as $product){
        $watch = new Product();
        $r=random_int(0, count(CategoryFixtures::CATEGORIES)-1);
        $c=random_int(0, count(self::CASES)-1);
        $b=random_int(0, count(self::BRACELET)-1);



        $watch->setName($product['name']);
        $watch->setDescription($product["description"]);
        $watch->setPrice($product["price"]);
        $watch->setReference(substr(str_shuffle(md5(random_int(0, 1000000))), 0, 25));
        $watch->setImage($product["image"]);
        $watch->setQuantity($product["qty"]);
        $watch->setCategory($this->getReference('category_'.$r));
        $watch->setCases(self::CASES[$c]);
        $watch->setBracelet(self::BRACELET[$b]);

        $manager->persist($watch);
    }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            CasesFixtures::class,
            BraceletsFixtures::class
        ];
    }
}
