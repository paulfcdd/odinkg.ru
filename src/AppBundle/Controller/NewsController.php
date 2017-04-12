<?php

namespace AppBundle\Controller;


use AppBundle\Entity\News;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
     * @return Response
     * @Route("/news", name="news.list")
     */
    public function newsListPageAction(){

        return $this->render(':odinkg/front/news:news_list.html.twig', [
            'news' => $this->getDoctrine()->getRepository(News::class)->findByDateRemoved(null),
        ]);

    }

    /**
     * @param News $post
     * @return Response
     * @Route("/news/post{post}", name="news.post")
     */
    public function newsPostAction(News $post) {

        $doctrine = $this->getDoctrine();

        $prevPost = $doctrine->getRepository(News::class)->find($post->getId() - 1);

        $nextPost = $doctrine->getRepository(News::class)->find($post->getId() + 1);

        return $this->render(':odinkg/front/news:news_post.html.twig', [
            'post' => $post,
            'prevPost' => $prevPost,
            'nextPost' => $nextPost,
        ]);
    }

    public function latestPostWidgetAction() {

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(News::class);

        $qb = $em->createQueryBuilder('p')
            ->setMaxResults(4)
            ->orderBy('p.dateCreated', 'DESC')
            ->getQuery();

        return $this->render(':odinkg/front/news/widget:widget_latest-post.html.twig', [
            'latest' => $qb->getResult()
        ]);

    }
}