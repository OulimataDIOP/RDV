<?php

namespace App\Form;

use App\Entity\Prestations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;



class PrestationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('titre', TextType::class, [
                //"label" => "Nom de la prestation",
                "required" => false,
                "attr" => [
                    "placeholder" => "Saisir le nom de la prestation",
                    "class" => "bg-warning",
                    
                    
                ]
            ])
            ->add('prix', MoneyType::class, [
                "currency" => "EUR",
                //"label" => "Prix du produit",
                "required" => false,
                "attr" => [
                    "placeholder" => "Saisir le prix de la prestation",
                    "class" => "bg-warning",
                    
                    
                ]
            ])
            ->add('image', FileType::class, [
                "required" => false,
                'data_class' => null,
                //"multiple" => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestations::class,
        ]);
    }
}
