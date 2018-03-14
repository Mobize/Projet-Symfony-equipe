<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Rencontre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RencontreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                  'date',
                  DateType::class,
                    [
                        'label' => 'Date',
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
            ->add(
                  'equipe1',
                    EntityType::class,
                    [
                        'label' => 'ID Equipe 1',
                        'class' => Equipe::class,
                        //nom du champ qui s'affiche dans les <option>
                        'choice_label' => 'nom',
                        //1ère option vide
                        'placeholder' => 'Choisissez une catégorie',
                        'attr' => [
                            'class' => 'perso'
                        ]                        
                    ]
                )
            ->add(
                  'equipe2',
                    EntityType::class,
                    [
                        'label' => 'ID Equipe 2',
                        'class' => Equipe::class,
                        //nom du champ qui s'affiche dans les <option>
                        'choice_label' => 'nom',
                        //1ère option vide
                        'placeholder' => 'Choisissez une catégorie',
                        'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )              
            ->add(
                  'lieu',
                    TextType::class,
                    [
                        'label' => 'Lieu',
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
            'data_class' => Rencontre::class,
        ]);
    }
}
