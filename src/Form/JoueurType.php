<?php

namespace App\Form;

use App\Entity\Equipe;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class JoueurType extends AbstractType
{  
    private $tokenStorage;


    public function __construct(TokenStorageInterface $tokenStorage) {
        $this->tokenStorage = $tokenStorage;
    }

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $club = $this->tokenStorage->getToken()->getUser()->getClub();
        
        $builder
           /* ->add(
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
                    )*/
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
            /*->add(
                    'mel',
                    EmailType::class,
                    [
                        'label' => 'Courriel'
                    ]
                ) */
                
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
            ->add('equipe',
                  //<select> sur une équipe
                  EntityType::class,
                  [
                      'label' => 'Associé à l\'équipe',
                      'class' => Equipe::class,
                      'query_builder' => function (EntityRepository $er) use ($club) {
                            return $er->createQueryBuilder('e')
                                    ->where('e.local = :local')
                                    ->setParameter('local',1)
                                    ->andWhere('IDENTITY(e.club) = :club')
                                    ->setParameter('club', $club->getId())
                            ;
                        },
                      //nom du champ qui s'affiche dans les <option>
                      'choice_label' => 'nom',
                      //1ère option vide
                      'placeholder' => 'Choisissez une équipe du club',
                       'attr' => [
                            'class' => 'perso'
                        ]             
                  ]  
                ) 
                                
                //pour création de l'user
                ->add(
                    'user',
                    BasicUserType::class
                )
        ;
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            
    
        ]);
    }
}
