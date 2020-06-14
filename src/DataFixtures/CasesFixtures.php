<?php

namespace App\DataFixtures;

use App\Entity\Cases;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CasesFixtures extends Fixture
{
    const CASES = [
        'Acier',
        'Or',
        'Titan'
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::CASES as $slug => $name) {
            $cases = new Cases();
            $cases->setName($name);
            $manager->persist($cases);
            $this->addReference('cases_'.$slug, $cases);
        }

        $manager->flush();
    }
}