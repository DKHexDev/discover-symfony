<?php

namespace App\Model;

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
    public function __construct($name, $description, $price)
    {
        $this->name = $name;
        // Génération du slug automatiquement.
        $this->slug = strtolower(str_replace(' ', '-', $name));
        $this->description = $description;
        $this->price = $price;
    }


    // Méthodes
    // --

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