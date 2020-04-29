<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer
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
     * @ORM\Column(name="tax_number", type="string", length=32, nullable=false)
     * @Annotation\Options({"label":"Tax number"})
     */
    private $taxNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="name_contact", type="string", length=64, nullable=false)
     * @Annotation\Options({"label":"Contact person"})
     */
    private $nameContact;

    /**
     * @var string
     *
     * @ORM\Column(name="name_company", type="string", length=64, nullable=false)
     * @Annotation\Options({"label":"Company name"})
     */
    private $nameCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line_1", type="string", length=64, nullable=false)
     * @Annotation\Options({"label":"Address Line 1"})
     */
    private $addressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line_2", type="string", length=64, nullable=false)
     * @Annotation\Options({"label":"Address Line 1"})
     */
    private $addressLine2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     * @Annotation\Attributes({"type":"hidden"})
     * @Annotation\Options({"label":"Is active"})
     */
    private $isActive = '1';



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
     * Set taxNumber
     *
     * @param string $taxNumber
     *
     * @return Customer
     */
    public function setTaxNumber($taxNumber)
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    /**
     * Get taxNumber
     *
     * @return string
     */
    public function getTaxNumber()
    {
        return $this->taxNumber;
    }

    /**
     * Set nameContact
     *
     * @param string $nameContact
     *
     * @return Customer
     */
    public function setNameContact($nameContact)
    {
        $this->nameContact = $nameContact;

        return $this;
    }

    /**
     * Get nameContact
     *
     * @return string
     */
    public function getNameContact()
    {
        return $this->nameContact;
    }

    /**
     * Set nameCompany
     *
     * @param string $nameCompany
     *
     * @return Customer
     */
    public function setNameCompany($nameCompany)
    {
        $this->nameCompany = $nameCompany;

        return $this;
    }

    /**
     * Get nameCompany
     *
     * @return string
     */
    public function getNameCompany()
    {
        return $this->nameCompany;
    }

    /**
     * Set addressLine1
     *
     * @param string $addressLine1
     *
     * @return Customer
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Get addressLine1
     *
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Set addressLine2
     *
     * @param string $addressLine2
     *
     * @return Customer
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Get addressLine2
     *
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Customer
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
}
