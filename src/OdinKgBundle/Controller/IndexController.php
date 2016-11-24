<?php
/**
 * Created by PhpStorm.
 * User: paulnovikov
 * Date: 24.11.2016
 * Time: 11:38
 */

namespace OdinKgBundle\Controller;


class IndexController extends BaseController
{
	public function indexAction(){
		return self::render('OdinKgBundle:OdinKg:index.html.twig', [
			'test'=> 'test',
		]);
	}
}