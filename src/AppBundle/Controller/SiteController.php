<?php

namespace AppBundle\Controller;


use AppBundle\Entity\ServicePage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SiteController extends Controller
{
    public function indexAction(){

       $em = $this->getDoctrine()->getManager();

       return $this->render('odinkg/front/index.html.twig',[
		    'services' => $em->getRepository(ServicePage::class)->findAll()
        ]);
	}

	public function saleAction(){
	    return $this->render('odinkg/front/sale.html.twig', []);
    }

    public function contactAction(){
	    return $this->render('odinkg/front/contact.html.twig');
    }

    public function rentAction(){
        return $this->render('odinkg/front/rent.html.twig');
    }

    public function notFoundAction(){
        return $this->render('TwigBundle/views/Exception/error404.html.twig');
    }
}