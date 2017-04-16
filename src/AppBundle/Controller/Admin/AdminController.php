<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route, Method
};
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AdminController
 * @package AppBundle\Controller\Admin
 * @Route("/dashboard")
 */
class AdminController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="admin")
     */
    public function dashboardAction(){

        return $this->render('odinkg/admin/dashboard.html.twig');
    }

    /**
     * @param File $file
     * @return JsonResponse
     * @Route("/delete-file/{file}",  name="admin.delete_file")
     * @Method("POST")
     */
    public function deleteFile(File $file) {

        $crudable = $this
            ->get('app.crudable')
            ->setData($file);

        if ($crudable->deleteFile()) {
            return JsonResponse::create();
        } else {
            return JsonResponse::create($crudable->deleteFile(), 500);
        }

    }

}