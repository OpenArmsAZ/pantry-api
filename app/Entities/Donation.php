<?php

namespace OpenArms\Pantry\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * A Product Donation
 *
 * @ORM\Table(name="donations")
 * @ORM\Entity
 */
class Donation extends AbstractEntity
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
     * @ORM\ManyToOne(
     *     targetEntity="Product",
     *     inversedBy="donations",
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
    protected $shareable_quantity;

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
}
