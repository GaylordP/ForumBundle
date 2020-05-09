<?php

namespace GaylordP\ForumBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use GaylordP\ForumBundle\Entity\Forum;
use GaylordP\ForumBundle\Entity\ForumPost;
use GaylordP\ForumBundle\Entity\ForumSubject;

class ForumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Forum::class);
    }

    public function findAll(): array
    {
        return $this->findBy([], ['order' => 'ASC']);
    }

    public function countPostByForumId(array $forumIds): array
    {
        return $this
            ->createQueryBuilder('forum')
            ->leftJoin(ForumSubject::class, 'subject', 'WITH', '
                subject.forum = forum
            ')
            ->leftJoin(ForumPost::class, 'post', 'WITH', '
                post.forumSubject = subject
            ')
            ->andWhere('forum.id IN(:forumIds)')
            ->setParameter('forumIds', $forumIds)
            ->select('
                forum.id AS forum_id,
                COUNT(post) AS countPost
            ')
            ->groupBy('forum')
            ->getQuery()
            ->getResult()
        ;
    }

    public function lastPostByForumId(array $forumIds): array
    {
        $lastPost = $this
            ->_em
            ->createQueryBuilder()
            ->from('App:ForumSubject', 'subSubject')
            ->leftJoin('App:ForumPost', 'subPost', 'WITH', '
                subPost.forumSubject = subSubject
            ')
            ->andWhere('subSubject.forum = forum')
            ->select('MAX(subPost)')
        ;

        return $this
            ->createQueryBuilder('forum')
            ->leftJoin('App:ForumPost', 'post', 'WITH', '
                post = (' . $lastPost->getDQL() . ')
            ')
            ->leftJoin('post.forumSubject', 'subject')
            ->leftJoin('post.createdBy', 'user')
            ->leftJoin('user.userMedia', 'userMedia')
            ->leftJoin('userMedia.media', 'media')
            ->leftJoin('user.color', 'color')
            ->andWhere('forum.id IN(:forumIds)')
            ->setParameter('forumIds', $forumIds)
            ->select('
                forum.id AS forum_id,
                post,
                subject,
                user,
                userMedia,
                media,
                color
            ')
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }
}
