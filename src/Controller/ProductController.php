<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductController extends AbstractController
{
    #[Route('/{slug}', name: 'product_category')]
    public function category($slug, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
        if (!$category) {
            throw $this->createNotFoundException("la categorie demandee n' existe pas");
        }

        return $this->render('product/category.html.twig', [
            'slug' => $slug,
            'category' => $category
        ]);
    }
    #[Route('/{category_slug}/{slug}', name: 'product_show')]
    public function show($slug, ProductRepository $productRepository)
    {

        $product = $productRepository->findOneBy(['slug' => $slug]);
        if (!$product) {
            throw $this->createNotFoundException("le produit demandee n' existe pas");
        }

        return $this->render('product/show.html.twig', [

            'product' => $product,

        ]);
    }
    #[Route("/admin/product/create", name: 'product_create')]
    public function create(FormFactoryInterface $factory)
    {
        $builder = $factory->createBuilder();
        $builder->add('name', TextType::class, [
            'label' => 'Nom du produit',
            'attr' => ['placeholder' => 'tapez le nom du produit']
        ])
            ->add('shortDescreption', TextareaType::class, [
                'label' => 'Descreption du peoduit',
                'attr' => ['placeholder' => 'tapez une descreption']

            ])
            ->add('price', MoneyType::class, [
                'label' => 'prix du produit',
                'attr' => ['placeholder' => 'tapez le prix du produit']
            ])


            ->add('category', EntityType::class, [
                'label' => 'Categorie',
                'attr' => [],
                'placeholder' => '--choisir une categorie--',
                'class' => Category::class,
                'choice_label' => 'name'

            ]);


        $form = $builder->getForm();
        $formView = $form->createView();
        return $this->render('product/create.html.twig', ['formView' => $formView]);
    }
}
