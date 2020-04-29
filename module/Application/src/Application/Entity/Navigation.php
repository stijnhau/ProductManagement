<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Navigation
 *
 * @ORM\Table(name="navigation", indexes={@ORM\Index(name="parent_id", columns={"parent_id"}), @ORM\Index(name="user_role_id", columns={"user_role_id"})})
 * @ORM\Entity
 */
class Navigation
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255, nullable=false)
     */
    private $route;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=64, nullable=false)
     */
    private $action = '';

    /**
     * @var \Application\Entity\Navigation
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Navigation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \Application\Entity\UserRole
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\UserRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_role_id", referencedColumnName="id")
     * })
     */
    private $userRole;



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
     * @return Navigation
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
     * Set label
     *
     * @param string $label
     *
     * @return Navigation
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Navigation
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return Navigation
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set parent
     *
     * @param \Application\Entity\Navigation $parent
     *
     * @return Navigation
     */
    public function setParent(\Application\Entity\Navigation $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Application\Entity\Navigation
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set userRole
     *
     * @param \Application\Entity\UserRole $userRole
     *
     * @return Navigation
     */
    public function setUserRole(\Application\Entity\UserRole $userRole = null)
    {
        $this->userRole = $userRole;

        return $this;
    }

    /**
     * Get userRole
     *
     * @return \Application\Entity\UserRole
     */
    public function getUserRole()
    {
        return $this->userRole;
    }
}
