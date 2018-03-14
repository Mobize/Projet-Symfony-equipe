<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'prenom',
                    TextType::class,
                    ['label'=>'Prénom'
                        ]
                    )
            ->add(
                    'nom',
                    TextType::class,
                    ['label'=>'Nom'
                        ]
                    )
            ->add(
                    'rue',
                    TextType::class,
                    ['label'=>'Rue'
                        ]
                    )
            ->add(
                    'cp',
                    TextType::class,
                    ['label'=>'Code postal'
                        ]
                    )
            ->add(
                    'ville',
                    TextType::class,
                    ['label'=>'Ville'
                        ]
                    )
            ->add(
                    'tel1',
                    TextType::class,
                    ['label'=>'N° de tél.'
                        ]
                    )
            ->add(
                    'tel2',
                    TextType::class,
                    ['label'=>'N° de tél. autre contact'
                        ]
                    )
            ->add(
                    'mel',
                    EmailType::class,
                    [
                        'label' => 'Courriel'
                    ]
                ) 
                
            ->add(
                    'dateNaissance',
                    BirthdayType::class,
                    [
                        'label' => 'Date de naissance',
                        'format'=> 'dd MM yyyy'
                   
                    ]
                ) 
                
                
            ->add(
                    'genre',
                    ChoiceType::class, array
                    (
                        'label'=>"Vous êtes",
                        'choices'=>array (
                        'Une femme' => 'F',
                        'Un homme' => 'H',
                         )
                    )                      
                ) 
                
                
                
            ->add(
                    'image',
                    FileType::class,
                    [
                       'label'=>"Photo d'identité",
                       'required'=>false
                    ]
                    )
                
        
            ->add(
                    'certificat',
                    FileType::class,
                    [
                     'label'=>"certificat de santé",
                     'required'=>false
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
