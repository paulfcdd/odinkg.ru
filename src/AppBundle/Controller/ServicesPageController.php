<?php

namespace AppBundle\Controller;


use AppBundle\Entity\ServicePage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ServicesPageController extends Controller
{
    public function singleServiceAction($service_name, Request $request)
    {
        /** @var ServicePage $servicePage */
        $service = $this->getDoctrine()->getRepository(ServicePage::class)->findOneBySlug($service_name);

        if ($service == null) {
            return $this->redirectToRoute('not_found');
        }
        return $this->render('odinkg/front/single_service.html.twig', [
            'service' => $service
        ]);
    }
}