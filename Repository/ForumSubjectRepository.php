<?php

namespace GaylordP\ForumBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use GaylordP\ForumBundle\Entity\ForumPost;
use GaylordP\ForumBundle\Entity\ForumSubject;
use GaylordP\PaginatorBundle\Paginator;

class ForumSubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumSubject::class);
    }

    public function findByForumIdPaginated(
        string $forumId,
        int $page = 1
    ): Paginator {
        $qb = $this
            ->createQueryBuilder('subject')
            ->innerJoin('App:ForumPost', 'postLast', 'WITH', '
                postLast.forumSubject = subject
            ')
            ->leftJoin('App:ForumPost', 'postMax', 'WITH', '
                postMax.forumSubject = subject AND
                postLast.id < postMax.id
            ')
            ->andWhere('subject.forum = :forum_id')
            ->andWhere('postMax.id IS NULL')
            ->select('
                subject
            ')
            ->orderBy('postLast.id', 'DESC')
            ->setParameter('forum_id', $forumId)
        ;

        return (new Paginator($qb))->paginate($page);
    }

    public function countReplyBySubjectId(array $subjectIds): array
    {
        return $this
            ->createQueryBuilder('subject')
            ->leftJoin('App:ForumPost', 'post', 'WITH', '
                post.forumSubject = subject
            ')
            ->andWhere('subject.id IN (:subjectIds)')
            ->setParameter('subjectIds', $subjectIds)
            ->select('
                subject.id AS subject_id,
                GREATEST(COUNT(post) - 1, 0) AS countReply
            ')
            ->groupBy('subject.id')
            ->getQuery()
            ->getResult()
        ;
    }

    public function lastPostBySubjectId(array $subjectIds): array
    {
        return $this
            ->createQueryBuilder('subject')
            ->leftJoin('App:ForumPost', 'postLast', 'WITH', '
                postLast.forumSubject = subject
            ')
            ->leftJoin('App:ForumPost', 'postMax', 'WITH', '
                postMax.forumSubject = subject AND
                postLast.id < postMax.id
            ')
            ->leftJoin('postLast.createdBy', 'user')
            ->leftJoin('user.userMedia', 'userMedia')
            ->leftJoin('userMedia.media', 'media')
            ->leftJoin('user.color', 'color')
            ->andWhere('subject.id IN (:subjectIds)')
            ->andWhere('postMax.id IS NULL')
            ->setParameter('subjectIds', $subjectIds)
            ->select('
                subject.id AS subject_id,
                postLast,
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

    public function speakerBySubjectId(array $subjectIds): array
    {
        $queryResults = $this
            ->createQueryBuilder('subject')
            ->leftJoin('App:ForumPost', 'post', 'WITH', '
                post.forumSubject = subject
            ')
            ->leftJoin('post.createdBy', 'user')
            ->leftJoin('user.userMedia', 'userMedia')
            ->leftJoin('userMedia.media', 'media')
            ->leftJoin('user.color', 'color')
            ->andWhere('subject.id IN (:subjectIds)')
            ->setParameter('subjectIds', $subjectIds)
            ->select('
                subject.id AS subject_id,
                post,
                user,
                userMedia,
                media,
                color
            ')
            ->orderBy('post.id', 'ASC')
            ->groupBy('subject.id, post.createdBy')
            ->getQuery()
            ->getResult()
        ;

        $results = [];

        foreach ($queryResults as $queryResult) {
            if ($queryResult[0] instanceof ForumPost) {
                $results[$queryResult['subject_id']][$queryResult[0]->getCreatedBy()->getId()] =
                    $queryResult[0]->getCreatedBy()
                ;
            } else {
                $results[$queryResult['subject_id']] = [];
            }
        }

        return $results;
    }

    public function userLastPostReadBySubjectId(array $subjectIds, string $userId): array
    {
        return $this
            ->createQueryBuilder('subject')
            ->innerJoin('App:ForumSubjectLastPostRead', 'lastPostRead', 'WITH', '
                lastPostRead.forumSubject = subject AND
                lastPostRead.user = :userId
            ')
            ->andWhere('subject.id IN (:subjectIds)')
            ->setParameter('userId', $userId)
            ->setParameter('subjectIds', $subjectIds)
            ->select('
                subject.id AS subject_id,
                lastPostRead
            ')
            ->getQuery()
            ->getResult()
        ;
    }
}
