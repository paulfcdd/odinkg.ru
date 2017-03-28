<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\{
    News
};

use AppBundle\Form\NewsType;
use Doctrine\ORM\EntityManager;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route, Method
};

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\{
    Response, Request
};

class NewsController extends Controller
{
    /**
     * @param Request $request
     * @Route("/dashboard/news", name="admin.news")
     * @return Response
     */
    public function newsPageAction(Request $request)
    {
        return $this->render(':odinkg/admin/news:news_list.html.twig');
    }

    /**
     * @param Request $request
     * @param News $news
     * @return Response
     * @Route("/dashboard/news/manage/{news}", name="admin.news.manage")
     */
    public function manageNewsAction(Request $request, News $news = null)
    {

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(NewsType::class, $news)
            ->handleRequest($request);


        return $this->render(':odinkg/admin/news:news_manage.html.twig', [
            'form' => $form->createView()
        ]);

    }
}