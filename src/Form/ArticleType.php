<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Article;
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
            ->add('title',
            TextType::class,
                    [
                        'label' => 'Titre',
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
            ->add('resume',
            TextareaType::class,
                    [
                        'label' => 'Résumé',
                         'attr' => [
                            'class' => 'perso'
                        ]             
                    ]
                )
 
     
            ->add('image',
                    //input type file
                    FileType::class,
                    [
                        'label' => 'Illustration',
                        'required' => false, 'attr' => [
                        'class' => 'perso'
                        ]             
                    ]
            )    
        ;
        
        //$options['data'] = L'entité Article
        // si il y a une image enregistrée en bdd
        if (!is_null($options['data']->getImage())){
            $builder->add(
                    'remove_image',
                    CheckboxType::class,
                    [
                        'label' => "Supprimer l'illustration",
                        'required' => false,
                        //champ non relié à un attribut de l'entité Article
                        'mapped' => false
                    ]
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Article::class,
        ]);
    }
}
