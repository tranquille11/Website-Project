<?php

namespace WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders_Items
 *
 * @ORM\Table(name="orders__items")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\Orders_ItemsRepository")
 */
class Orders_Items
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
     * @ORM\ManyToOne(targetEntity="Orders", inversedBy="items")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */

    private $order;

    /**
     * @ORM\Column(name="quantity", type="integer")
     */

    private $quantity;
    /**
     * @ORM\Column(name="product_id", type="integer")
     */

    private $product_id;

    /**
     * @ORM\Column(name="price_per_item", type="decimal", precision=7, scale=2)
     */

    private $price;

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
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }




}

