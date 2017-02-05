<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function dashboardAction(){

        return $this->render('odinkg/admin/dashboard.html.twig');
    }
}