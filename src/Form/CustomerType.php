<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Customer_FirstName', TextType::class,[
                'label'=>'Nom utilisateur',
                'attr'=>[
                    'placeholder'=>'Nom utilisateur',
                ]
            ])
            ->add('Customer_LastName', TextType::class,[
                'label'=>'Prenom utilisateur',
                'attr'=>[
                    'placeholder'=>'Prenom utilisateur',
                ]

            ])
            ->add('Customer_Avatar', FileType::class,[
                'label'=>'Avatar:',
                'attr'=>[
                    'placeholder'=>'Photo de profil',
                ]
            ])
            ->add('Customer_PositionHeld', TextType::class,[
                'label'=>'Poste occupe',
                'attr'=>[
                    'label'=>'Poste occupe',
                    'placeholder'=>'Poste occupe',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
