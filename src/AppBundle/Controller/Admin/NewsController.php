<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\{
    News, File
};

use AppBundle\Form\NewsType;
use Doctrine\ORM\EntityManager;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route, Method
};

use function Sodium\add;
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
     * @param News $object
     * @return JsonResponse
     * @Route("/dashboard/news/bin/restore/{object}", name="admin.news.bin.restore")
     */
    public function restoreFromBin(News $object) {
        try {
            $this
                ->get('app.crudable')
                ->setData($object)
                ->restore();
            return JsonResponse::create();
        } catch (Exception $exception) {
            return JsonResponse::create('Error', 500);
        }

    }

    /**
     * @param News $object
     * @Route("/dashboard/news/delete/{object}", name="admin.news.delete")
     * @Method("POST")
     * @return JsonResponse
     */
    public function deleteNewsAction(News $object)
    {
        $this
            ->get('app.crudable')
            ->setData($object)
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

        $form = $this
            ->createForm(NewsType::class, $news)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$form->getData()->getAuthor()) {
                $form->getData()->setAuthor($this->getUser());
            }

            if ($form->getData()->getDateCreated()) {
                $form->getData()->setDateUpdated(new \DateTime());
            }

            $crudable = $this
                ->get('app.crudable')
                ->setData($form->getData());

            if (!empty($form['files']->getData())) {
                $crudable
                    ->setPhotos($form['files']->getData())
                    ->setUploadDir('news');
            }

            return $this->redirectToRoute('admin.news.manage', [
                'news' => $crudable->save()
            ]);
        }

        return $this->render(':odinkg/admin/news:news_manage.html.twig', [
            'news' => $news,
            'form' => $form->createView()
        ]);
    }
}