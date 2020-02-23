<?php

namespace WebsiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */

    private $name;


    /**
     * @ORM\OneToMany(targetEntity="Categories", mappedBy="category")
     */

    private $subcategories;


    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="subcategories")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */

    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */

    private $products;

    public function __construct()
    {
        $this->subcategories = new ArrayCollection();
        $this->products = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Categories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubcategories(): ArrayCollection
    {
        return $this->subcategories;
    }

    /**
     * @param ArrayCollection $subcategories
     */
    public function setSubcategories(ArrayCollection $subcategories)
    {
        $this->subcategories = $subcategories;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getSubcategoryName()
    {
        return $this->subcategory_name;
    }

    /**
     * @param mixed $subcategory_name
     */
    public function setSubcategoryName($subcategory_name)
    {
        $this->subcategory_name = $subcategory_name;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts(ArrayCollection $products): void
    {
        $this->products = $products;
    }





}

