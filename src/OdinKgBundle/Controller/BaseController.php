<?php
/**
 * Created by PhpStorm.
 * User: paulnovikov
 * Date: 24.11.2016
 * Time: 11:35
 */

namespace OdinKgBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
	public static function index(string $view, array $parameters){
		return self::render($view, $parameters);
	}
}