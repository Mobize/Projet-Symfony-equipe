<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Rencontre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                        'label' => 'Equipe 1/Equipe du club',
                        'class' => Equipe::class,
                        //nom du champ qui s'affiche dans les <option>
                        'choice_label' => 'nom',
                        //1ère option vide
                        'placeholder' => 'Choisissez une équipe du club ',
                        'attr' => [
                            'class' => 'perso'
                        ]                        
                    ]
                )
            ->add(
                  'equipe2',
                    EntityType::class,
                    [
                        'label' => 'Equipe 2/Equipe extérieure',
                        'class' => Equipe::class,
                        //nom du champ qui s'affiche dans les <option>
                        'choice_label' => 'nom',
                        //1ère option vide
                        'placeholder' => 'Choisissez une équipe extérieure',
                        'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                ) 
            ->add(
                'domicile',
                ChoiceType::class, array
                (
                    'label'=>"A domicile/En extérieur",
                    'choices'=>array (
                    'Match à domicile' => true,
                    'Match extérieur' => false),
            'choices_as_values' => true,'multiple'=>false,'expanded'=>true)                 
            )    
            ->add(
                  'lieu',
                    TextType::class,
                    [
                        'label' => 'Lieu de la rencontre',
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )  
            ->add(
                  'equipe1Score',
                  IntegerType::class,
                    [
                        'label' => "Score de l'équipe 1",
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )   
            ->add(
                  'equipe2Score',
                  IntegerType::class,
                    [
                        'label' => "Score de l'équipe 2",
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
