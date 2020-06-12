<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Collection femme',
        'Collection homme',
        'Collection unisex'
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $slug => $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $this->addReference('category_'.$slug, $category);
        }

        $manager->flush();
    }
}

