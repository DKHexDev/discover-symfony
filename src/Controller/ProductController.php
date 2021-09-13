<?php

namespace App\Controller;

use App\Model\Product;
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
        array_push(self::$products, new Product('iPhone X', 'Un iPhone de 2017', '999'));
        array_push(self::$products, new Product('iPhone XR', 'Un iPhone de 2018', '1099'));
        array_push(self::$products, new Product('iPhone XS', 'Un iPhone de 2018', '1119'));
    }

    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        // La vue des produits
        return $this->render('product/index.html.twig', [
            'products' => self::$products
        ]);
    }

    /**
     * @Route("/product/random", name="product_random")
     */
    public function productRandom()
    {
        // Définition de $product, c'est un produit choisi aléatoirement. 
        $product = self::$products[array_rand(self::$products)];

        return $this->render('product/product.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/product/create", name="product_create")
     */
    public function productCreate()
    {
        // La vue de la création du produit.
        return $this->render('product/create.html.twig');
    }

    /**
     * @Route("/product/{page}", name="product_page", requirements={"page": "\d+"})
     */
    public function productPage($page)
    {
        // On doit récupérer 2 produits
        // Si on est sur la page 1, on récupère l'index 0 et 1
        // Si on est sur la page 2, on récupère l'index 2 et 3
        // Si on est sur la page 3, on récupère l'index 4 et 5
        $products = array_chunk(self::$products, 2);
        /* Le chunk fait la transformation suivante :
            [
              0 => ['iphone x', 'iphone xs'],
              1 => ['iphone xr', 'iphone 11'],
              2 => ['iphone 12']
            ]
        */
        if (!isset($products[$page - 1])) {
            throw $this->createNotFoundException("La page $page n'existe pas.");
        }

        return $this->render('product/index.html.twig', [
            'products' => $products[$page - 1],
            'page' => $page,
        ]);
    }

    /**
     * @Route("/product/{slug}", name="product_slug")
     */
    public function productSlug($slug)
    {
        // On défini oneProduct.
        $oneProduct = null;

        // Définition de oneProduct, le produit avec le slug mis en paramètre.
        foreach(self::$products as $product)
        {
            if ($product->getSlug() === $slug) $oneProduct = $product;
        };

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
     * @Route("/product/order/{slug}", name="product_order")
     */
    public function productOrder($slug)
    {
        // On défini oneProduct.
        $oneProduct = null;

        // Définition de oneProduct, le produit avec le slug mis en paramètre.
        foreach(self::$products as $product)
        {
            if ($product->getSlug() === $slug) $oneProduct = $product;
        };

        // On vérifie que oneProduct existe.
        if (!$oneProduct)
        {
            $this->addFlash('error', 'Un problème est survenue, nous n\'avons pas pû enregistrer votre commande, veuillez réessayer.');
            return $this->redirectToRoute('product');
        }

        $this->addFlash('success', 'Nous avons bien pris en compte votre commande '. $oneProduct->getName() .' de '. $oneProduct->getPrice() .' €');
        return $this->redirectToRoute('product');
    }

    /**
     * @Route("/product.json", name="product_json")
     */
    public function productJSON()
    {
        return $this->json(['products' => self::$products]);
    }

}