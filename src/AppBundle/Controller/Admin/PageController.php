<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Page;
use AppBundle\Form\PageContentType;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Annotations\Annotation;

class PageController extends Controller
{

    public function listPagesAction(){
        $repo = $this->getDoctrine()->getRepository(Page::class);

        return $this->render('odinkg/admin/service_page/list.html.twig', [
            'pages' => $repo->findAll()
        ]);
    }

    /**
     * @param Request $request
     * @param Page|null $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function managePageAction(Request $request, Page $page = null){

        $doctrine = $this->getDoctrine()->getManager();

        $error = null;

        $form = $this->createForm(PageContentType::class, $page);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $form->getData()->setDateCreated(\DateTime::createFromFormat('d-m-Y', date('d-m-Y')));
            $doctrine->persist($form->getData());
            try {
                $doctrine->flush();
                return $this->redirectToRoute('service_page.list');
            } catch (DBALException $exception) {
                $error = [
                    'message' => 'При добавлении страницы возникла ошибка: страница с такими параметрами существует',
                    'code' => $exception->getCode()
                ];
            }
        }

        return $this->render('odinkg/admin/service_page/manage.html.twig', [
            'form' => $form->createView(),
            'page' => $page,
            'error' => $error,
        ]);
    }
}