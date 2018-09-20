<?php

namespace OpenArms\Pantry\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * User
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Product extends AbstractEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=false, unique=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, unique=false)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=true, unique=true)
     */
    protected $upc;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $default_shareable_quantity;

    /**
     * @var InventoryLevel
     *
     * @ORM\OneToOne(
     *     targetEntity="InventoryLevel",
     *     mappedBy="product",
     *     cascade={"all"},
     *     fetch="EAGER"
     * )
     */
    protected $inventory_level;

    /**
     * @var Donation
     *
     * @ORM\OneToMany(
     *     targetEntity="Donation",
     *     mappedBy="product",
     *     cascade={"all"},
     *     fetch="LAZY"
     * )
     */
    protected $donations;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getUpc(): string
    {
        return $this->upc;
    }

    /**
     * @param string $upc
     */
    public function setUpc(string $upc)
    {
        $this->upc = $upc;
    }

    /**
     * @return int
     */
    public function getDefaultShareableQuantity(): int
    {
        return $this->default_shareable_quantity;
    }

    /**
     * @param int $default_shareable_quantity
     */
    public function setDefaultShareableQuantity(int $default_shareable_quantity)
    {
        $this->default_shareable_quantity = $default_shareable_quantity;
    }

    /**
     * @return InventoryLevel
     */
    public function getInventoryLevel(): InventoryLevel
    {
        if(is_null($this->inventory_level)) {
            $this->inventory_level = new InventoryLevel();
            $this->inventory_level->setProduct($this);
        }

        return $this->inventory_level;
    }

    /**
     * @param InventoryLevel $inventory_level
     */
    public function setInventoryLevel(InventoryLevel $inventory_level)
    {
        $inventory_level->setProduct($this);
        $this->inventory_level = $inventory_level;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }
}
