<?php

namespace Application\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Order
 *
 * @ORM\Table(name="`order`", indexes={@ORM\Index(name="customer_id", columns={"customer_id"})})
 * @ORM\Entity
 */
class Order
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Attributes({"type":"hidden"})
     * @Annotation\Options({"label":"Id"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     * @Annotation\Options({"label":"Name"})
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_order", type="string", nullable=false)
     * @Annotation\Options({"label":"Date ordered"})
     * @Annotation\Attributes({"id":"dateOrder"})
     */
    private $dateOrder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="string", nullable=false)
     * @Annotation\Options({"label":"Date placed"})
     * @Annotation\Attributes({"id":"dateCreated"})
     */
    private $dateCreated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     * @Annotation\Attributes({"type":"hidden"})
     * @Annotation\Options({"label":"Is active"})
     */
    private $isActive = '1';

    /**
     * @var \Application\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * })
     * @Annotation\Options({"label":"Customer"})
     */
    private $customer;

    public function __construct()
    {
        $this->dateOrder = date("Y-m-d H:i");
        $this->dateCreated = date("Y-m-d H:i");
    }

    /**
     * Get id
     *
     * @return integer
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
     * @return Order
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
     * Set dateOrder
     *
     * @param \DateTime $dateOrder
     *
     * @return Order
     */
    public function setDateOrder($dateOrder)
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    /**
     * Get dateOrder
     *
     * @return \DateTime
     */
    public function getDateOrder()
    {
        return $this->dateOrder;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Order
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Order
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set customer
     *
     * @param \Application\Entity\Customer $customer
     *
     * @return Order
     */
    public function setCustomer(\Application\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Application\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
