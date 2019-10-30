<?php

namespace App\Form;

use App\Entity\UserAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                'label'=>'Login: ',
                'attr'=>[
                    'placeholder'=>'Mot de passe'
                ]])
            ->add('password', PasswordType::class,[
                'label'=>'Password: ',
                'attr'=>[
                    'placeholder'=>'Mot de passe'
                ]
            ])
            //->add('IsAdmin')
            //->add('level')
            //->add('createdAt')
            //->add('customer')
        ;
    }











    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserAccount::class,
        ]);
    }
}
