<?php

namespace GaylordP\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GaylordP\UserBundle\Annotation\CreatedAt;
use GaylordP\UserBundle\Annotation\CreatedBy;
use GaylordP\UserBundle\Entity\Traits\Deletable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ForumPost
 *
 * @ORM\Entity(repositoryClass="GaylordP\ForumBundle\Repository\ForumPostRepository")
 */
class ForumPost
{
    use Deletable;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"forums_posts_read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Groups({"forums_posts_read"})
     */
    private $content;

    /**
     * @var ForumSubject
     *
     * @ORM\ManyToOne(
     *     targetEntity="GaylordP\ForumBundle\Entity\ForumSubject",
     * )
     * @Groups({"forums_posts_read"})
     */
    private $forumSubject;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @CreatedAt
     * @Groups({"forums_posts_read"})
     */
    private $createdAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\User",
     *     fetch="EAGER"
     * )
     * @CreatedBy
     * @Groups({"forums_posts_read"})
     */
    private $createdBy;

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
     * Get content
     *
     * @return string 
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     * 
     * @param string $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * Get forum subject
     * 
     * @return ForumSubject
     */
    public function getForumSubject(): ?ForumSubject
    {
        return $this->forumSubject;
    }

    /**
     * Set forum subject
     * 
     * @param ForumSubject $forumSubject
     */
    public function setForumSubject(?ForumSubject $forumSubject): void
    {
        $this->forumSubject = $forumSubject;
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
