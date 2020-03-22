<?php

namespace WebsiteBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="WebsiteBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=50)
     */
    private $surname;
    /**
     * @var string
     *
     * @ORM\Column(name="email_address", type="string", length=50)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=50)
     */
    private $address1;
    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=50)
     */
    private $address2;
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     */
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50)
     */
    private $state;
    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=50)
     */
    private $zipcode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED_AT", type="datetime")
     */
    private $cREATEDAT;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */

    private $userId;

    /**
     * @@ORM\OneToMany(targetEntity="Orders_Items", mappedBy="order")
     */

    private $items;

    public function __construct()
    {
        $this->cREATEDAT = new DateTime();
        $this->items = new ArrayCollection();

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
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Set cREATEDAT
     *
     * @param \DateTime $cREATEDAT
     *
     * @return Orders
     */
    public function setCREATEDAT($cREATEDAT)
    {
        $this->cREATEDAT = $cREATEDAT;

        return $this;
    }

    /**
     * Get cREATEDAT
     *
     * @return \DateTime
     */
    public function getCREATEDAT()
    {
        return $this->cREATEDAT;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1(string $address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2(string $address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
    public function setProducts(ArrayCollection $products)
    {
        $this->products = $products;
    }
}

