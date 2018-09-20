<?php

namespace OpenArms\Pantry\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Single Product Inventory Level
 *
 * @ORM\Table(name="inventory_levels")
 * @ORM\Entity
 */
class InventoryLevel extends AbstractEntity
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
     * @var Product
     *
     * @ORM\OneToOne(
     *     targetEntity="Product",
     *     inversedBy="inventory_level",
     *     cascade={"all"},
     *     fetch="LAZY"
     * )
     */
    protected $product;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $shareable_quantity = 0;

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
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

    public function addShareableQuantity(int $quantity)
    {
        $this->shareable_quantity += $quantity;
    }

    /**
     * @return int
     */
    public function getShareableQuantity(): int
    {
        return $this->shareable_quantity;
    }

    /**
     * @param int $shareable_quantity
     */
    public function setShareableQuantity(int $shareable_quantity)
    {
        $this->shareable_quantity = $shareable_quantity;
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

    public function jsonSerialize()
    {
        $data = get_object_vars($this);

        unset($data['product']);

        foreach ($data as $key => $value) {
            if (substr($key, 0, 2) === '__') {
                // Remove the doctrine '__initializer__', '__cloner__', etc...
                unset($data[$key]);
            }

            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
