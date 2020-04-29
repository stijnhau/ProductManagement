<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Allergen
 *
 * @ORM\Table(name="allergen", indexes={@ORM\Index(name="is_active", columns={"is_active"}), @ORM\Index(name="naam", columns={"name"})})
 * @ORM\Entity
 * @Annotation\Name("alergen")
 */
class Allergen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Attributes({"type":"hidden"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Name"})
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     * @Annotation\Attributes({"type":"hidden"})
     */
    private $isActive = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp_created", type="datetime", nullable=false)
     * @Annotation\Exclude().
     */
    private $timestampCreated = '';



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
     * @return Allergen
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Allergen
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
     * @return Allergen
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

    public function __construct()
    {
        $this->timestampCreated = new \DateTime();
    }
}
