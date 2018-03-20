<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Rencontre;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
                
                
      /*      ->add('equipe1',
            EntityType::class,
                    [
                        'label' => 'Equipe 1/Equipe du club',
                        'class'=> Rencontre::class,
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
            ->add('equipe2',
            EntityType::class,
                    [
                        'label' => 'Équipe 2',
                        'class'=> Rencontre::class,
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
            ->add('lieu',
            EntityType::class,
                    [
                        'label' => 'Lieu',
                        'class'=> Rencontre::class,
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
            ->add('date',
            EntityType::class,
                    [
                        'label' => 'Date',
                        'class'=> Rencontre::class,
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )*/
            ->add('title',
            TextType::class,
                    [
                        'label' => 'Titre',
                        'class'=> Article::class,
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
            ->add('content',
            TextareaType::class,
                    [
                        'label' => 'Contenu',
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                ) 
            /*->add('fullname',
             EntityType::class,
                    [
                        'label' => 'Auteur',
                        'class'=> User::class,
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )*/
                  
            ->add('image',
                FileType::class,
                    [
                        'label' => 'Illustration',
                        'required' => false, 'attr' => [
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
            'data_class' => Article::class,
        ]);
    }
}
