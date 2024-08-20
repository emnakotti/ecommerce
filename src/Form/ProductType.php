<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\DataTransformer\CentimesTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => ['placeholder' => 'tapez le nom du produit'],
                'required' => false,
                'constraints' => new NotBlank(['message' => "validation du formulaire : le nom du produit ne peut pas etre vide!"])
            ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Descreption du peoduit',
                'attr' => ['placeholder' => 'tapez une descreption'],
                'required' => false,
                'constraints' => new NotBlank(['message' => "validation du formulaire : la description du produit ne peut pas etre vide!"])

            ])
            ->add('price', MoneyType::class, [
                'label' => 'prix du produit',
                'attr' => ['placeholder' => 'tapez le prix du produit'],
                'divisor' => 100,
                'required' => false,
                'constraints' => new NotBlank(['message' => "validation du formulaire : le prix du produit ne peut pas etre vide!"])
            ])
            ->add('mainPicture', UrlType::class, [
                'label' => 'Image du produit',
                'attr' => ['Placeholder' => 'tapez un URL d\'image'],
                'required' => false,
                'constraints' => new NotBlank(['message' => "validation du formulaire : l'url de l'image du produit ne peut pas etre vide!"])
            ])
            ->add('category', EntityType::class, [
                'label' => 'Categorie',
                'attr' => [],
                'placeholder' => '--choisir une categorie--',
                'class' => Category::class,
                'choice_label' => 'name',
                'required' => false,
                'constraints' => new NotBlank(['message' => "validation du formulaire : l'url de l'image du produit ne peut pas etre vide!"])

            ]);

        // $builder->get('price')->addModelTransformer(new CentimesTransformer);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
