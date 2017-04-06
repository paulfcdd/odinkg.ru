<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\{
    News, Image
};

use AppBundle\Form\NewsType;
use Doctrine\ORM\EntityManager;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route, Method
};

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\{
    JsonResponse, Response, Request
};

class NewsController extends Controller
{
    /**
     * @Route("/dashboard/news", name="admin.news")
     * @return Response
     */
    public function newsPageAction()
    {
        return $this->render(':odinkg/admin/news:news_list.html.twig', [
            'news' => $this->getDoctrine()->getRepository(News::class)->findByDateRemoved(null)
        ]);
    }

    /**
     * @Route("/dashboard/news/bin", name="admin.news.bin")
     */
    public function binAction(){

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(News::class);

        $removed = $em->createQueryBuilder('n')
            ->where('n.dateRemoved IS NOT NULL')
            ->getQuery();

        return $this->render(':odinkg/admin/news:news_bin.html.twig', [
            'objects' => $removed->getResult(),
        ]);

    }

    /**
     * @param News $news
     * @Route("/dashboard/news/delete/{news}", name="admin.news.delete")
     * @Method("POST")
     * @return JsonResponse
     */
    public function deleteNewsAction(News $news)
    {
        $this
            ->get('app.crudable')
            ->setData($news)
            ->delete();

        return JsonResponse::create();
    }

    /**
     * @param Request $request
     * @param News|null $news
     * @return Response
     * @Route("/dashboard/news/manage/{news}", name="admin.news.manage", defaults={"news"=null})
     */
    public function manageNewsAction(Request $request, News $news = null) {

//        var_dump($news->getId());

        $em = $this->getDoctrine()->getManager();

        $form = $this
            ->createForm(NewsType::class, $news)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$news) {
                $form->getData()->setAuthor($this->getUser());
            }

            $crudable = $this
                ->get('app.crudable')
                ->setUploadDir('news')
                ->setPhotos($form['image']->getData())
                ->setData($form->getData());

            return $this->redirectToRoute('admin.news.manage', [
                'news' => $crudable->add()
            ]);
        }

        return $this->render(':odinkg/admin/news:news_manage.html.twig', [
            'form' => $form->createView()
        ]);

    }
}