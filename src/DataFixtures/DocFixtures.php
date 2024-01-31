<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Level;
use App\Entity\Subject;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
;

class DocFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $levels = ['CP', 'CE1', 'CE2', 'CM1', 'CM2', 'Sixième', 'Cinquième', 'Quatrième', 'Troisième', 'Seconde', 'Première', 'Terminale'];
        foreach ($levels as $levelName) {
            $level = new Level();
            $level->setName($levelName);
            $manager->persist($level);
        }
        
        $types = ['Cours', 'Fiche d\'exercices', 'Evaluation', 'Devoir en temps libre', 'Séquence / Chapitre'];
        foreach ($types as $typeName) {
            $type = new Type();
            $type->setName($typeName);
            $manager->persist($type);
        }
        
        $subjects = ['Anglais', 'Allemand', 'Espagnol', 'Italien', 'Mathématiques', 'Physique-Chimie', 'SVT', 'Technologie', 'Français', 'Philosophie', 'Histoire-Géographie', 'SES', 'Education musicale', 'Arts Plastiques'];
        foreach ($subjects as $subjectName) {
            $subject = new Subject(); 
            $subject->setName($subjectName);
            $manager->persist($subject);
        }

        $manager->flush();
    }
}
