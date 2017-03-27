<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    /**
     * @param Request $request
     * @Route("/news", name="news.list")
     */
    public function newsListPage(Request $request){

        return $this->render(':odinkg/front/news:news_list.html.twig');

    }
}