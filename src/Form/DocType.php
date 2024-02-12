<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Level;
use App\Entity\Theme;
use App\Entity\Subject;
use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DocType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('level', EntityType::class, [
                'class' => Level::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => true,
                'expanded' => true,
            ])
            ->add('subject', EntityType::class, [
                'class' => Subject::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => true,
                'expanded' => true,
            ])
            ->add('theme', EntityType::class, [
                'class' => Theme::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => true,
                'expanded' => true,
            ])
            ->add('file', FileType::class, [
                'label' => 'Votre fichier',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-tex'
                        ],
                        'mimeTypesMessage' => 'Nous n\'acceptons pour le moment que les fichiers PDF ou LaTeX.'
                    ]),
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Déposer le document',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
