<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'prenom',
                    TextType::class,
                    [
                        'label' => 'Prénom',
                        'attr' => [
                            'class' => 'perso'
                        ]
                    ]        
            )
            ->add(
            'nom',
                    TextType::class,
                    [
                        'label' => 'Nom',
                        'attr' => [
                            'class' => 'perso'
                        ]
                    ]        
            )
            ->add(
            'fonction',
                    TextType::class,
                    [
                        'label' => 'Fonction',
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
            // uncomment if you want to bind to a class
            //'data_class' => Staff::class,
        ]);
    }
}
