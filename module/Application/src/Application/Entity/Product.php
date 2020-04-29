<?php
namespace Application\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="name", columns={"name"}), @ORM\Index(name="is_active", columns={"is_active"})})
 * @ORM\Entity
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Annotation\Options({"label":"Name"})
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     * @Annotation\Attributes({"type":"hidden"})
     * @Annotation\Options({"label":"Is active"})
     */
    private $isActive = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="best_before", type="string", length=64, nullable=false)
     * @Annotation\Options({"label":"Best before"})
     */
    private $bestBefore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp_created", type="datetime", nullable=false)
     * @Annotation\Exclude().
     */
    private $timestampCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="storage_temperature", type="integer", nullable=false)
     * @Annotation\Options({"label":"Storage temperature"})
     * @Annotation\Validator({"name":"Digits", "options":{"messages":{"notDigits": "The storage temperature should be numeric."}}})
     * @Annotation\Validator({"name":"Between", "options":{"min":-99, "max":100, "messages":{"notBetween": "The storage temperature is not between -99 and 100."}}})
     */
    private $storageTemperature;

    /**
     * @var string
     *
     * @ORM\Column(name="plu", type="string", length=64, nullable=false)
     * @Annotation\Options({"label":"Plu"})
     */
    private $plu;

    /**
     * @var string
     *
     * @ORM\Column(name="process", type="text", nullable=false)
     * @Annotation\Options({"label":"Process"})
     * @Annotation\Attributes({"type":"textarea"})
     */
    private $process;

    /**
     * @var string
     *
     * @ORM\Column(name="ingredients", type="text", nullable=false)
     * @Annotation\Options({"label":"Ingredients"})
     * @Annotation\Attributes({"type":"textarea"})
     */
    private $ingredients;



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
     * @return Product
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
     * @return Product
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
     * Set bestBefore
     *
     * @param string $bestBefore
     * @return Product
     */
    public function setBestBefore($bestBefore)
    {
        $this->bestBefore = $bestBefore;

        return $this;
    }

    /**
     * Get bestBefore
     *
     * @return string
     */
    public function getBestBefore()
    {
        return $this->bestBefore;
    }

    /**
     * Set timestampCreated
     *
     * @param \DateTime $timestampCreated
     * @return Product
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
     * Set timestampUpdated
     *
     * @param \DateTime $timestampUpdated
     * @return Product
     */
    public function setTimestampUpdated($timestampUpdated)
    {
        $this->timestampUpdated = $timestampUpdated;

        return $this;
    }

    /**
     * Get timestampUpdated
     *
     * @return \DateTime
     */
    public function getTimestampUpdated()
    {
        return $this->timestampUpdated;
    }

    /**
     * Set storageTemperature
     *
     * @param integer $storageTemperature
     * @return Product
     */
    public function setStorageTemperature($storageTemperature)
    {
        $this->storageTemperature = $storageTemperature;

        return $this;
    }

    /**
     * Get storageTemperature
     *
     * @return integer
     */
    public function getStorageTemperature()
    {
        return $this->storageTemperature;
    }

    /**
     * Set plu
     *
     * @param string $plu
     * @return Product
     */
    public function setPlu($plu)
    {
        $this->plu = $plu;

        return $this;
    }

    /**
     * Get plu
     *
     * @return string
     */
    public function getPlu()
    {
        return $this->plu;
    }

    /**
     * Set process
     *
     * @param string $process
     * @return Product
     */
    public function setProcess($process)
    {
        $this->process = $process;

        return $this;
    }

    /**
     * Get process
     *
     * @return string
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * Set ingredients
     *
     * @param string $ingredients
     * @return Product
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * Get ingredients
     *
     * @return string
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }


    public function __construct()
    {
        $this->timestampCreated = new \DateTime();
        $this->timestampUpdated = new \DateTime();
    }

    public function createAllergen(array $allergen, EntityManager $entityManager)
    {
        $repositoryLink = $entityManager->getRepository('Application\Entity\ProductAllergen');
        $repositoryAlergen = $entityManager->getRepository('Application\Entity\Allergen');

        $links = $repositoryLink->findBy(
            array(
                "isActive"  => 1,
                "product"   => $this,
            )
        );
        foreach ($links as $link) {
            /* @var $link \Application\Entity\ProductAllergen */
            $link->setIsActive(0);
        }
        $entityManager->flush();

        foreach ($allergen as $key => $value) {
            if ($value > 0) {
                /* @var $allergen \Application\Entity\Allergen */
                $allergen = $repositoryAlergen->find($value);

                $link = $repositoryLink->findBy(
                    array(
                        "isActive"  => 0,
                        "product"   => $this,
                        "allergen"  => $allergen,
                    )
                );
                if (count($link) == 0) {
                    $link = new ProductAllergen();
                    $link->setAllergen($allergen);
                    $link->setProduct($this);
                    $link->setTimestampCreated(new \DateTime());

                    $entityManager->persist($link);
                } else {
                    $link[0]->setIsActive(true);
                }
                $entityManager->flush();
            }
        }
    }

    public function getAllAllergen(EntityManager $entityManager)
    {
        $arrAllergen        = array();
        $repositoryAlergen  = $entityManager->getRepository('Application\Entity\Allergen');
        $repositoryLink     = $entityManager->getRepository('Application\Entity\ProductAllergen');

        $allergen = $repositoryAlergen->findBy(
            array(
                "isActive"  => 1,
            )
        );
        foreach ($allergen as $allergeen) {
            /* @var $allergeen \Application\Entity\Allergen */
            $productAllergeen = $repositoryLink->findBy(
                array(
                    "isActive"  => 1,
                    "product"   => $this,
                    "allergen"  => $allergeen,
                )
            );
            if (count($productAllergeen) == 1) {
                $arrAllergen[] = $allergeen;
            }
        }

        return $arrAllergen;
    }
}
