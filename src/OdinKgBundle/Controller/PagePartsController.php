<?php
namespace OdinKgBundle\Controller;

class PagePartsController extends BaseController
{

	public function headerAction(){
		$em = $this->getDoctrine()->getManager();
		$pages = $em->getRepository('OdinKgBundle:Page')->findAll();
		return parent::render('OdinKgBundle:OdinKg:header.html.twig', [
			'pages' => $pages,
		]);
	}

	public function footerAction(){
		return parent::render('OdinKgBundle:OdinKg:footer.html.twig', []);
	}
}