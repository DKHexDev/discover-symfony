<?php

namespace App\Controller;

use App\Product\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    // private static $products = [
    //     [
    //         'name' => "iPhone X",
    //         'slug' => "iphone-x",
    //         'description' => "Un iPhone de 2017",
    //         'price' => "999"
    //     ],
    //     [
    //         'name' => "iPhone XR",
    //         'slug' => "iphone-xr",
    //         'description' => "Un iPhone de 2018",
    //         'price' => "1099"
    //     ],
    //     [
    //         'name' => "iPhone XS",
    //         'slug' => "iphone-xs",
    //         'description' => "Un iPhone de 2018",
    //         'price' => "1119"  
    //     ]
    // ];

    private static $products = [];

    /**
     * @return void Ne retourne rien.
     */
    public function __construct()
    {
        array_push(self::$products, new Product('iPhone X', 'iphone-x', 'Un iPhone de 2017', '999'));
        array_push(self::$products, new Product('iPhone XR', 'iphone-xr', 'Un iPhone de 2018', '1099'));
        array_push(self::$products, new Product('iPhone XS', 'iphone-xs', 'Un iPhone de 2018', '1119'));
    }

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
    public function product($slug)
    {
        // On défini oneProduct.
        $oneProduct = null;

        if ($slug === 'create')
        {
            // La vue de la création du produit.
            return $this->render('product/create.html.twig');
        }
        else if ($slug === 'random')
        {     
            // Redéfini oneProduct, avec un produit choisi aléatoirement.    
            $oneProduct = self::$products[rand(0, count(self::$products) - 1)];
        }
        else if (is_numeric($slug))
        {
            // Définition de oneProduct, avec le numéro passer en paramètre.
            $oneProduct = isset(self::$products[$slug]) ? self::$products[$slug] : null;
        }
        else
        {
            // Définition de oneProduct, le produit avec le slug mis en paramètre.
            foreach(self::$products as $product)
            {
                if ($product->getSlug() === $slug) $oneProduct = $product;
            };
        }

        // On vérifie que oneProduct existe.
        if (!$oneProduct)
        {
            throw $this->createNotFoundException('Ce produit n\'existe pas');
        }

        // La vue du produit.
        return $this->render('product/product.html.twig', [
            'product' => $oneProduct,
        ]);
    }

    /**
     * @Route("/product.json", name="product_json")
     */
    public function productJSON()
    {
        return $this->json(['products' => self::$products]);
    }
}