<?php

namespace GaylordP\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GaylordP\ColorBundle\Entity\Color;
use GaylordP\UserBundle\Annotation\CreatedAt;
use GaylordP\UserBundle\Annotation\CreatedBy;
use GaylordP\UserBundle\Entity\Traits\Deletable;
use GaylordP\SluggableBundle\Annotation\Sluggable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Forum
 *
 * @ORM\Entity(repositoryClass="GaylordP\ForumBundle\Repository\ForumRepository")
 */
class Forum
{
    use Deletable;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"forums_read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"forums_read"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"forums_read"})
     */
    private $description;

    /**
     * @var Color
     *
     * @ORM\ManyToOne(
     *     targetEntity="GaylordP\ColorBundle\Entity\Color",
     *     fetch="EAGER"
     * )
     * @Groups({"forums_read"})
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     * @Groups({"forums_read"})
     */
    private $ico;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", name="_order", options={"unsigned"=true})
     * @Assert\NotBlank()
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Sluggable("name")
     * @Groups({"forums_read"})
     */
    private $slug;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @CreatedAt
     */
    private $createdAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @CreatedBy
     */
    private $createdBy;

    /**
     * Get name
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     * 
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description
     * 
     * @param string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * Get color
     * 
     * @return Color
     */
    public function getColor(): ?Color
    {
        return $this->color;
    }

    /**
     * Set color
     * 
     * @param Color $color
     */
    public function setColor(?Color $color): void
    {
        $this->color = $color;
    }

    /**
     * Get ico
     *
     * @return string 
     */
    public function getIco(): ?string
    {
        return $this->ico;
    }

    /**
     * Set ico
     * 
     * @param string $ico
     */
    public function setIco(?string $ico): void
    {
        $this->ico = $ico;
    }

    /**
     * Get order
     *
     * @return int 
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }

    /**
     * Set order
     * 
     * @param int $order
     */
    public function setOrder(?int $order): void
    {
        $this->order = $order;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Set slug
     * 
     * @param string $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $date
     */
    public function setCreatedAt(\DateTime $date): void
    {
        $this->createdAt = $date;
    }

    /**
     * Get createdBy
     *
     * @return User
     */
    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    /**
     * Set createdBy
     *
     * @param User $user
     */
    public function setCreatedBy(User $user): void
    {
        $this->createdBy = $user;
    }
}
