<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => ['placeholder' => 'tapez le nom du produit']
            ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Descreption du peoduit',
                'attr' => ['placeholder' => 'tapez une descreption']

            ])
            ->add('price', MoneyType::class, [
                'label' => 'prix du produit',
                'attr' => ['placeholder' => 'tapez le prix du produit']
            ])
            ->add('mainPicture', UrlType::class, [
                'label' => 'Image du produit',
                'attr' => ['Placeholder' => 'tapez un URL d\'image']
            ])


            ->add('category', EntityType::class, [
                'label' => 'Categorie',
                'attr' => [],
                'placeholder' => '--choisir une categorie--',
                'class' => Category::class,
                'choice_label' => 'name'

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
