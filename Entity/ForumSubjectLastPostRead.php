<?php

namespace GaylordP\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ForumSubjectLastPostRead
 *
 * @ORM\Entity(repositoryClass="GaylordP\ForumBundle\Repository\ForumSubjectLastPostReadRepository")
 */
class ForumSubjectLastPostRead
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\User",
     * )
     * @Assert\NotBlank()
     */
    private $user;

    /**
     * @var ForumSubject
     *
     * @ORM\ManyToOne(
     *     targetEntity="GaylordP\ForumBundle\Entity\ForumSubject"
     * )
     */
    private $forumSubject;

    /**
     * @var ForumPost
     *
     * @ORM\ManyToOne(
     *     targetEntity="GaylordP\ForumBundle\Entity\ForumPost"
     * )
     */
    private $forumPost;

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
     * Get user
     * 
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set user
     * 
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
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
     * Get forum post
     * 
     * @return ForumPost
     */
    public function getForumPost(): ?ForumPost
    {
        return $this->forumPost;
    }

    /**
     * Set forum post
     * 
     * @param ForumPost $forumPost
     */
    public function setForumPost(?ForumPost $forumPost): void
    {
        $this->forumPost = $forumPost;
    }
}
