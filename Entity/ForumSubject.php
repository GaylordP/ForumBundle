<?php

namespace GaylordP\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GaylordP\SluggableBundle\Annotation\Sluggable;
use GaylordP\UserBundle\Entity\Traits\Deletable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ForumSubject
 *
 * @ORM\Entity(repositoryClass="GaylordP\ForumBundle\Repository\ForumSubjectRepository")
 */
class ForumSubject
{
    public const NUM_ITEMS = 15;

    use Deletable;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"forums_subjects_read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"forums_subjects_read"})
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Sluggable("subject")
     * @Groups({"forums_subjects_read"})
     */
    private $slug;

    /**
     * @var Forum
     *
     * @ORM\ManyToOne(
     *     targetEntity="GaylordP\ForumBundle\Entity\Forum",
     * )
     */
    private $forum;

    /**
     * Get subject
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->getSubject();
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
     * Get subject
     *
     * @return string 
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set subject
     * 
     * @param string $subject
     */
    public function setSubject(?string $subject): void
    {
        $this->subject = $subject;
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
     * Get forum
     * 
     * @return Forum
     */
    public function getForum(): ?Forum
    {
        return $this->forum;
    }

    /**
     * Set forum
     * 
     * @param Forum $forum
     */
    public function setForum(?Forum $forum): void
    {
        $this->forum = $forum;
    }
}
