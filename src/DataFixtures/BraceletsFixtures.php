<?php

namespace App\DataFixtures;

use App\Entity\Bracelets;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BraceletsFixtures extends Fixture
{
    const BRACELET = [
        'Acier',
        'Or',
        'Titan',
        'Cuire',
        'Céramique',
        'Caoutchouc'
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::BRACELET as $slug => $name) {
            $bracelet = new Bracelets();
            $bracelet->setName($name);
            $manager->persist($bracelet);
            $this->addReference('bracelet_'.$slug, $bracelet);
        }

        $manager->flush();
    }
}
