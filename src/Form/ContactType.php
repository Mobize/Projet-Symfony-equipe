<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                     'prenom',
                     TextType::class,
                    [
                        'label' => 'Prenom',
                        'attr' => [
                            'class' => 'perso'
                        ]
                    ]
                     )
                ->add(
                    'mel',
                     EmailType::class,
                    [
                        'label' => 'Email',
                        'attr' => [
                            'class' => 'perso'
                        ]
                    ]
                )
                ->add('message',
                    TextareaType::class,
                    [
                        'label' => 'message',
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
            'data_class' => Contact::class,
        ]);
    }
}
