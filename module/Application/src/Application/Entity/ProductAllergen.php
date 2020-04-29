<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductAllergen
 *
 * @ORM\Table(name="product_allergen", uniqueConstraints={@ORM\UniqueConstraint(name="product_id", columns={"product_id", "allergen_id"})}, indexes={@ORM\Index(name="allergen_id", columns={"allergen_id"}), @ORM\Index(name="IDX_EE0F62594584665A", columns={"product_id"})})
 * @ORM\Entity
 */
class ProductAllergen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp_created", type="datetime", nullable=false)
     */
    private $timestampCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var \Application\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Application\Entity\Allergen
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Allergen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="allergen_id", referencedColumnName="id")
     * })
     */
    private $allergen;



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
     * Set isActive
     *
     * @param boolean $isActive
     * @return ProductAllergen
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
     * Set timestampCreated
     *
     * @param \DateTime $timestampCreated
     * @return ProductAllergen
     */
    public function setTimestampCreated($timestampCreated)
    {
        $this->timestampCreated = $timestampCreated;

        return $this;
    }

    /**
     * Get timestampCreated
     *
     * @return \DateTime
     */
    public function getTimestampCreated()
    {
        return $this->timestampCreated;
    }

    /**
     * Set product
     *
     * @param \Application\Entity\Product $product
     * @return ProductAllergen
     */
    public function setProduct(\Application\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Application\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set allergen
     *
     * @param \Application\Entity\Allergen $allergen
     * @return ProductAllergen
     */
    public function setAllergen(\Application\Entity\Allergen $allergen = null)
    {
        $this->allergen = $allergen;

        return $this;
    }

    /**
     * Get allergen
     *
     * @return \Application\Entity\Allergen
     */
    public function getAllergen()
    {
        return $this->allergen;
    }
}
