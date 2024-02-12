<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $passwordHasher = new PasswordHasherFactory(['auto' => ['algorithm' => 'auto']]);
        $user = new User();
        $user->setEmail('p.coelho@lapinou.tech')
            ->setFirstname('Pierre')
            ->setLastname('Coelho')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($passwordHasher->getPasswordHasher('auto')->hash('test'))
            ->setIsVerified(true);

        $manager->persist($user);
        $manager->flush();
    }
}
