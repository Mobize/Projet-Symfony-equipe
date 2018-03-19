<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaisonType extends AbstractType
{
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                  'dateDebut',
                  DateType::class,
                    [
                        'label' => 'Date de début de saison',
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
            ->add(
                  'dateFin',
                  DateType::class,
                    [
                        'label' => 'Date de fin de saison',
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
            ->add(
            'nom',
                    TextType::class,
                    [
                        'label' => 'Nom (ex: 2017-2018)',
                        'attr' => [
                            'class' => 'perso'
                        ]
                    ]        
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
