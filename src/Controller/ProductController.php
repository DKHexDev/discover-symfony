<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    private static $products = [
        [
            'name' => "iPhone X",
            'slug' => "iphone-x",
            'description' => "Un iPhone de 2017",
            'price' => "999"
        ],
        [
            'name' => "iPhone XR",
            'slug' => "iphone-xr",
            'description' => "Un iPhone de 2018",
            'price' => "1099"
        ],
        [
            'name' => "iPhone XS",
            'slug' => "iphone-xs",
            'description' => "Un iPhone de 2018",
            'price' => "1119"  
        ]
    ];

    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        // La vue des produits
        return $this->render('product/index.html.twig', [
            'products' => self::$products,
        ]);
    }

    /**
     * @Route("/product/{slug}", name="product_slug")
     */
    public function productSlug($slug)
    {
        $slug = trim(htmlspecialchars($slug));
        $oneProduct = null;

        // Définition de oneProduct, le produit avec le slug mis en paramètre.
        foreach(self::$products as $product) {
            if ($product['slug'] === $slug) {
                $oneProduct = $product;
            }
        };

        // On vérifie que oneProduct existe.
        if (!$oneProduct) {
            throw $this->createNotFoundException('Ce produit n\'existe pas');
            exit;
        }

        // La vue du produit.
        return $this->render('product/product.html.twig', [
            'product' => $oneProduct,
        ]);
    }

    /**
     * @Route("/products/random", name="product_random")
     */
    public function productRandom()
    {
        $product = self::$products[rand(0, count(self::$products) - 1)];

        // Vue du produit qui est choisi aléatoirement.
        return $this->render('product/product.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * 
     */
}
