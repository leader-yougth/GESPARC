<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomEntreprise', TextType::class, [
                'required'   => true,
                'attr'=>[
                    'placeholder'=>'Camtel'
                ]
            ])
            ->add('SecteurActivite', TextType::class, [
                'label'=>'Secteur Activite: ',
                'required'   => true,
                'attr'=>[
                    'placeholder'=>'Exemple : Comerce General '
                ]
            ])
            ->add('LogoEntreprise', FileType::class, [
                'required'   => false,
                'label'=>'logo',              
                'attr'=>[
                    'placeholder'=>'Chargez le logo'
                ]
            ])
            ->add('BoitePostal', TextType::class, [
                
                'required'   => true,
                'attr'=>[
                    'placeholder'=>'Exemple BP 450 Bafoussam'
                ]
                
            ])

            ->add('SiteWeb', TextType::class, [
                'required'   => false,
                'attr'=>[
                    'placeholder'=>'Exemple : www.siteweb.com'
                ]
            ])

            ->add('EmailEntreprise', TextType::class, [
                'required'   => true,
                'attr'=>[
                    'placeholder'=>'Exemple : mail@exemple.com'
                ]
            ])
            ->add('PaysEntreprise', TextType::class, [
                'required'   => true,
                'label'=>'Pays: ',
                'attr'=>[
                    'placeholder'=>'Exemple : Cameroun'
                ]
            ])
            ->add('VilleEntreprise', TextType::class, [
                'label'=>'Ville: ',
                'required'   => true,
                'attr'=>[
                    'placeholder'=>'Exemple : Yaounde'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
