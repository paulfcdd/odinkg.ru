<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SiteController extends Controller
{

	public function indexAction(){
		return $this->render('odinkg/front/index.html.twig',[]);
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
}