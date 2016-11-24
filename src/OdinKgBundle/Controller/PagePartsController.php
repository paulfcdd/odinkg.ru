<?php
namespace OdinKgBundle\Controller;


class PagePartsController extends BaseController
{
	public function headerAction(){
		return parent::render('OdinKgBundle:OdinKg:header.html.twig', []);
	}

	public function footerAction(){
		return parent::render('OdinKgBundle:OdinKg:footer.html.twig', []);
	}
}