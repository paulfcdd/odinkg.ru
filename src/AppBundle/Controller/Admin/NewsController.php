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
        return $this->render(':odinkg/admin/news:news_list.html.twig', [
            'news' => $this->getDoctrine()->getRepository(News::class)->findAll(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/dashboard/news/add", name="admin.news.add")
     */
    public function addNewsAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(NewsType::class)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form->getData()
                ->setDateCreated(new \DateTime())
                ->setAuthor($this->getUser());

            $em->persist($form->getData());

            $em->getConnection()->beginTransaction();

            try {
                $em->flush();

                $fileName = trim(strtolower(str_replace(' ', '_', ($form['image']->getData()['name']))));

                $uploader = $this->get('app.image_uploader')
                    ->setDir('news')
                    ->setFile($form['image']->getData()['file'])
                    ->setFileName($fileName)
                    ->upload();

                if ($uploader) {
                    $image = new Image();
                    $image
                        ->setForeignKey($form->getData()->getId())
                        ->setEntity(News::class)
                        ->setName($fileName.'.'.$form['image']->getData()['file']->getClientOriginalExtension())
                        ->setDescription($form['image']->getData()['description'])
                        ->setAlt(trim($form['image']->getData()['alt']))
                        ->setTitle(trim($form['image']->getData()['title']));
                    $em->persist($image);
                    $em->flush();
                    $em->getConnection()->commit();
                } else {
                    $em->getConnection()->rollback();
                    var_dump($uploader);
                    die;
                }
            } catch (Exception $exception) {
                $em->getConnection()->rollback();
            }


            return $this->redirectToRoute('admin.news.edit', [
                'news' => $form->getData()->getId()
            ]);

        }

        return $this->render(':odinkg/admin/news:news_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param News $news
     * @Route("/dashboard/news/edit/id{news}", name="admin.news.edit")
     * @return Response
     */
    public function editNewsAction(Request $request, News $news)
    {

        $em = $this->getDoctrine()->getManager();

        $form = $this
            ->createForm(NewsType::class, $news)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($form->getData());

            $em->flush();
        }

        return $this->render(':odinkg/admin/news:news_edit.html.twig', [
            'form' => $form->createView(),
            'news' => $news
        ]);
    }

    /**
     * @Route("/dashboard/news/delete/{news}", name="admin.news.delete")
     * @Method("POST")
     */
    public function deleteNewsAction(Request $request, News $news){

    }

    /**
     * @param Request $request
     * @Route("/test/test/test/", name="test.test")
     */
    public function testAction(Request $request){
        var_dump($request->request->all());
        die;
    }
}