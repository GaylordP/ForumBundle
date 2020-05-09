<?php

namespace GaylordP\ForumBundle\Controller;

use GaylordP\ForumBundle\Entity\Forum;
use GaylordP\ForumBundle\Entity\ForumPost;
use GaylordP\ForumBundle\Entity\ForumSubject;
use GaylordP\ForumBundle\EventListener\UserLastPostReadInSubjectListener;
use GaylordP\ForumBundle\Form\ForumPostType;
use GaylordP\ForumBundle\Form\ForumSubjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{
}
