<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    const NB_USERS = 10;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }



    public function load(ObjectManager $manager)
    {
        for($i=0; $i<self::NB_USERS; $i++){
            $user = new User();

            if($i === 0){
                $user->setUsername("client$i")
                    ->setEmail("prenom$i@test.com")
                    ->setFirstname("Prenom $i")
                    ->setLastname("Nom $i")
                    ->setRoles(["ROLE_ADMIN", "ROLE_USER"])
                    ->setPassword($this->passwordEncoder->encodePassword($user, "password$i"));

                $manager->persist($user);
            } else {
                $user->setUsername("client$i")
                    ->setEmail("prenom$i@test.com")
                    ->setFirstname("Prenom $i")
                    ->setLastname("Nom $i")
                    ->setRoles(["ROLE_USER"])
                    ->setPassword($this->passwordEncoder->encodePassword($user, "password$i"));

                $manager->persist($user);
            }
        }
        $manager->flush();
    }
}
