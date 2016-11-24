<?php
namespace OdinKgBundle\Controller;

/**
 * Class IndexController
 * @package OdinKgBundle\Controller
 */
class IndexController extends BaseController
{
	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function indexAction(){
		return parent::render('OdinKgBundle:OdinKg:index.html.twig', [
			'test'=> 'test',
			'title' => 'Main page'
		]);
	}
}