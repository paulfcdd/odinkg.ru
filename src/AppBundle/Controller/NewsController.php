<?php

namespace AppBundle\Controller;


use AppBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/news", name="news.list")
     */
    public function newsListPage(Request $request){

        return $this->render(':odinkg/front/news:news_list.html.twig', [
            'news' => $this->getDoctrine()->getRepository(News::class)->findAll(),
        ]);

    }
}