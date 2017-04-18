<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\{
    File, Object
};
use AppBundle\Form\ObjectType;
use Doctrine\ORM\{
    EntityManager, EntityRepository
};
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route, Method
};
use Symfony\Component\HttpFoundation\{
    Response, RedirectResponse, Request, JsonResponse
};

/**
 * Class ObjectController
 * @package AppBundle\Controller\Admin
 * @Route("/dashboard/object")
 */
class ObjectController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("", name="admin.object")
     */
    public function listObjectAction(){

        return $this->render(':odinkg/admin/object:object_list.html.twig',[
            'objects' => $this->getDoctrine()->getRepository(Object::class)->findAll(),
        ]);
    }

    /**
     * @param Object $object
     * @return JsonResponse
     * @Route("/dashboard/object/delete/{object}", name="admin.object.delete")
     * @Method("POST")
     */
    public function deleteObjectAction(Object $object){

        return $this
            ->get('app.crudable')
            ->setData($object)
            ->delete();
    }

    /**
     * @param Request $request
     * @param Object|null $object
     * @return RedirectResponse|Response
     * @Route("/manage/{object}", name="admin.object.manage")
     */
    public function manageObjectAction(Request $request, Object $object = null) {

        $form = $this
            ->createForm(ObjectType::class)
            ->setData($object)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $crud = $this
                ->get('app.crudable')
                ->setData($form)
                ->setUploadDir('objects');

            return $this->redirectToRoute('admin.object.manage', [
                'object' => $crud->save(),
            ]);
        }

        return $this->render('odinkg/admin/object/object_manage.html.twig', [
            'form' => $form->createView(),
            'object' => $object
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/bin", name="admin.object.bin")
     */
    public function objectBinAction () {

        /** @var EntityRepository $em */
        $em = $this->getDoctrine()->getRepository(Object::class);

        $query = $em->createQueryBuilder('o')
            ->where('o.dateRemoved IS NOT NULL')
            ->getQuery();

        return $this->render('odinkg/admin/object/object_bin.html.twig', [
            'objects' => $query->getResult(),
            'entity' => Object::class,
        ]);
    }

    /**
     * @param Object $object
     * @return Response
     * @Route("/{object}/repair", name="admin.object.bin.repair")
     * @Method("POST")
     */
    public function restoreObjectAction(Object $object) {
       return $this->get('app.crudable')
           ->setData($object)
           ->restore();
    }
}