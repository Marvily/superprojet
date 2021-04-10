<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0;$i <=10;$i++) {
            $user = new User();
            $user
                ->setEmail('email'.$i.'@test.fr')
                ->setNom('Test '.$i)
                ->setPrenom('Prenom '.$i)
                ->setPassword($this->passwordEncoder->encodePassword($user, 'test'))
                ->setRoles(['ROLE_TEACHER']);

            if ($i <= 2) {
                $user->setRoles(['ROLE_USER']);
            }

            if ($i > 2 && $i <= 4) {
                $user->setRoles(['ROLE_SUPER_ADMIN']);
            }

            $manager->persist($user);
        }
        // $product = new Product();

        $manager->flush();
    }
}
