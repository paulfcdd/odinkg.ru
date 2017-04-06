<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/dashboard", name="admin")
     */
    public function dashboardAction(){

        return $this->render('odinkg/admin/dashboard.html.twig');
    }

}