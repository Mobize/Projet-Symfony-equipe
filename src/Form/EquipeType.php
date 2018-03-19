<?php

namespace App\Form;

use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add(
                'local',
                ChoiceType::class, array
                (
                    'label'=>"Type d'équipe",
                    'choices'=>array (
                    'Equipe du club' => true,
                    'Equipe extérieure' => false),
            'choices_as_values' => true,'multiple'=>false,'expanded'=>true)                 
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
            ->add('image',
                    //input type file
                    FileType::class,
                    [
                        'label' => 'Illustration',
                        'required' => false
                    ]
            )      
        ;
        
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
            'data_class' => Equipe::class,
        ]);
    }
}
