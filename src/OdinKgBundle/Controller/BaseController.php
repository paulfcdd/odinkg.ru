<?php
namespace OdinKgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BaseController
 * @package OdinKgBundle\Controller
 */
class BaseController extends Controller
{

	/**
	 * @param string $view
	 * @param array $parameters
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public static function index(string $view, array $parameters){
		return self::render($view, $parameters);
	}
}