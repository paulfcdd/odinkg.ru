<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route, Method
};
use Symfony\Component\HttpFoundation\{
    JsonResponse, Request, Response
};

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
     * @param Request $request
     * @return Response
     * @Route("/bin/restore", name="admin.bin.restore")
     * @Method("POST")
     */
    public function binRestoreAction(Request $request) {

        return
            $this
                ->get('app.crudable')
                ->setData(
                    $this->getObject(
                        $request->request->get('entity'), $request->request->get('object')
                    )
                )
                ->restore();
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/bin/remove", name="admin.bin.remove")
     * @Method("POST")
     */
    public function binDeleteAction(Request $request) {

        return
            $this
                ->get('app.crudable')
                ->setData(
                    $this->getObject(
                        $request->request->get('entity'), $request->request->get('object')
                    )
                )
                ->delete();
    }

    /**
     * @param File $file
     * @return Response
     * @Route("/delete-file/{file}",  name="admin.delete_file")
     * @Method("POST")
     */
    public function deleteFile(File $file) {

         return $this
            ->get('app.crudable')
            ->setData($file)
            ->deleteFile();
    }

    /**
     * @param string $entity
     * @param string $object
     * @return mixed
     */
    private function getObject(string $entity, string $object) {
        return
            $this
                ->getDoctrine()
                ->getRepository($entity)
                ->findOneById($object);
    }

}