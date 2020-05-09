<?php

namespace GaylordP\ForumBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use GaylordP\ForumBundle\Entity\ForumSubjectLastPostRead;

class ForumSubjectLastPostReadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumSubjectLastPostRead::class);
    }
}
