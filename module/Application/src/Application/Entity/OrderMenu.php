<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderMenu
 *
 * @ORM\Table(name="order_menu", indexes={@ORM\Index(name="menu8id", columns={"menu_id"}), @ORM\Index(name="order_id", columns={"order_id"})})
 * @ORM\Entity
 */
class OrderMenu
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
     * @var \Application\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     * })
     */
    private $menu;

    /**
     * @var \Application\Entity\Order
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Order")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    private $order;



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
     * Set menu
     *
     * @param \Application\Entity\Menu $menu
     *
     * @return OrderMenu
     */
    public function setMenu(\Application\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Application\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set order
     *
     * @param \Application\Entity\Order $order
     *
     * @return OrderMenu
     */
    public function setOrder(\Application\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Application\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }
}
