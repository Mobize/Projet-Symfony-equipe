<?php

namespace App\Form;

use App\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                  'nom',
                  TextType::class,
                    [
                        'label' => 'Nom :'
                    ]
                )
            ->add(
                  'anneeCreation',
                  TextType::class,
                    [
                        'label' => 'Année de création :'
                    ]
                )
                
            ->add(
                  'sigle',
                  TextType::class,
                    [
                        'label' => 'Sigle Club :'
                    ]
                )
                
            ->add(
                  'couleurs',
                  TextType::class,
                    [
                        'label' => 'Couleurs du Club :'
                    ]
                )
                
            ->add(
                  'logo',
                  FileType::class,
                    [
                        'label' => 'Logo du Club :'
                    ]
                )
                
            ->add(
                  'stade',
                  TextType::class,
                    [
                        'label' => 'Adresse du stade :'
                    ]
                )
                
            ->add(
                  'statut',
                  TextType::class,
                    [
                        'label' => 'Statut social :'
                    ]
                )
                
            ->add(
                  'president',
                  TextType::class,
                    [
                        'label' => 'Président du Club :'
                    ]
                )
                
            ->add(
                  'ville',
                  TextType::class,
                    [
                        'label' => 'Ville domiciliée :'
                    ]
                )
                
            ->add(
                  'adresse',
                  TextType::class,
                    [
                        'label' => 'Adresse du Club :'
                    ]
                )
                
            ->add(
                  'email',
                  TextType::class,
                    [
                        'label' => 'E-mail :'
                    ]
                )
                
            ->add(
                  'telephone',
                  TextType::class,
                    [
                        'label' => 'Téléphone :'
                    ]
                )
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([    
            'data_class' => Club::class,    
            // uncomment if you want to bind to a class
            //'data_class' => Club::class,
        ]);
    }
}
