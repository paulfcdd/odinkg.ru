<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller
{

    /**
     * @Route("/admin/project", name="admin.project")
     */
    public function listProjectAction() {

        return $this->render(':odinkg/admin/project:project_list.html.twig');
    }

}