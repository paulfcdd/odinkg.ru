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
}