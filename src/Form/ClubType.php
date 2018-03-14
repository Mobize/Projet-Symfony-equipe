<?php

namespace App\Form;

use App\Entity\Club;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                        'label' => 'Nom :',
                        'attr' => [
                                    'class' => 'well' //Classe well pour la profondeur visuelle du champ
                                   ]
                    ]
                )
            ->add(
                  'anneeCreation',
                  TextType::class,
                    [
                        'label' => 'Année de création :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'sigle',
                  TextType::class,
                    [
                        'label' => 'Sigle Club :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'couleurs',
                  TextType::class,
                    [
                        'label' => 'Couleurs du Club :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'logo',
                  FileType::class,
                    [
                        'label' => 'Logo du Club :',
                        'attr' => [
                                    'class' => 'well'
                                   ],
                        'attr' => [
                                    'id' => 'toggle'
                                   ],
                        'required' => false
                    ]
                )
                
            ->add(
                  'stade',
                  TextType::class,
                    [
                        'label' => 'Adresse du stade :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'statut',
                  TextType::class,
                    [
                        'label' => 'Statut social :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'president',
                  TextType::class,
                    [
                        'label' => 'Président du Club :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'ville',
                  TextType::class,
                    [
                        'label' => 'Ville domiciliée :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'adresse',
                  TextType::class,
                    [
                        'label' => 'Adresse du Club :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'email',
                  TextType::class,
                    [
                        'label' => 'E-mail :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
            ->add(
                  'telephone',
                  TextType::class,
                    [
                        'label' => 'Téléphone :',
                        'attr' => [
                                    'class' => 'well'
                                   ]
                    ]
                )
                
        ;
        
         //$options['data'] = L'entité Club
        // si il y a une image enregistrée en bdd
        if (!is_null($options['data']->getLogo())) {
            $builder->add(
                    'remove_logo',
                    CheckboxType::class,
                    [
                        'label' => "Supprimer l'illustration",
                        'required' => false,
                        //champ non relié à un attribut de l'entité Club
                        'mapped' => false
                    ]
            );
        }
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
