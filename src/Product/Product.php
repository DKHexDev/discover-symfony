<?php

namespace App\Product;

class Product {

    // Définitions des propriétés
    // --

    private $name;
    private $slug;
    private $description;
    private $price;


    // Constructeur
    // --

    /**
     * @param string $name Nom du produit attendu.
     * @param string $slug Slug du produit attendu.
     * @param string $description Description du produit attendu.
     * @param string $price Prix du produit attendu.
     * @return object
     */
    public function __construct($name, $slug, $description, $price)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @return string Retourne le nom du produit.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string Retourne le slug du produit.
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string Retourne la description du produit.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string Retourne le prix du produit.
     */
    public function getPrice()
    {
        return $this->price;
    }

}