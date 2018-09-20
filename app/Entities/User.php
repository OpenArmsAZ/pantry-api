<?php

namespace OpenArms\Pantry\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User extends AbstractEntity
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
    protected $first_name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=false, unique=false)
     */
    protected $last_name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=false, unique=true)
     */
    protected $email_address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=false, nullable=true)
     */
    protected $recovery_token;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=75, nullable=false, unique=false)
     */
    protected $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    protected $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updated_at;

    public function __construct($data = null)
    {
        $this->created_at = new \DateTime();

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
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->email_address;
    }

    /**
     * @param string $email_address
     */
    public function setEmailAddress(string $email_address)
    {
        $this->email_address = $email_address;
    }

    /**
     * @return string
     */
    public function getRecoveryToken(): string
    {
        return $this->recovery_token;
    }

    /**
     * @param string $recovery_token
     */
    public function setRecoveryToken(string $recovery_token)
    {
        $this->recovery_token = $recovery_token;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }
}
