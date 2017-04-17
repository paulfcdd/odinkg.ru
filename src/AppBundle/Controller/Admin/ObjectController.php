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

        $id = $object->getId();

        $crudable = $this
            ->get('app.crudable')
            ->setData($object)
            ->delete();

        if ($crudable) {
            return JsonResponse::create($id, 200);
        } else {
            return JsonResponse::create('Error', 500);
        }
    }

    /**
     * @param Request $request
     * @param Object|null $object
     * @return RedirectResponse|Response
     * @Route("/manage/{object}", name="admin.object.manage")
     */
    public function manageObjectAction(Request $request, Object $object = null) {
        /** @var EntityManager $em */
        $em = $this
            ->getDoctrine()
            ->getManager();

        $form = $this
            ->createForm(ObjectType::class)
            ->setData($object)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudable = $this
                ->get('app.crudable')
                ->setData($form->getData());

            if (!empty($form['files']->getData())) {
                $crudable
                    ->setPhotos($form['files']->getData())
                    ->setUploadDir('objects');
            }

            return $this->redirectToRoute('admin.object.manage', [
                'object' => $crudable->save(),
            ]);
        }

        return $this->render('odinkg/admin/object/object_manage.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/dashboard/object/bin", name="admin.object.bin")
     */
    public function objectBinAction () {

        /** @var EntityRepository $em */
        $em = $this->getDoctrine()->getRepository(Object::class);

        $query = $em->createQueryBuilder('o')
            ->where('o.dateRemoved IS NOT NULL')
            ->getQuery();

        return $this->render(':odinkg/admin/object:bin.html.twig', [
            'objects' => $query->getResult()
        ]);
    }

    /**
     * @param Request $request
     * @param Object $object
     * @return JsonResponse
     * @Route("/dashboard/object/{object}/repair", name="admin.object.bin.repair")
     */
    public function repairObjectAction(Request $request, Object $object) {
        if ($request->isMethod('post')) {
            $em = $this->getDoctrine()->getManager();
            $object->setDateRemoved(null);
            $em->flush();
            return JsonResponse::create($object->getId(), 200);
        }
    }

    /**
     * @param Request $request
     * @param Object $object
     * @return JsonResponse
     * @Route("/dashboard/object/{object}/remove", name="admin.object.bin.remove")
     */
    public function removeFromBinAction(Request $request, Object $object){
        if ($request->isMethod('post')) {
            $objectId = $object->getId();
            $em = $this->getDoctrine()->getManager();
            $em->remove($object);
            $em->flush();
            return JsonResponse::create($objectId, 200);
        }
    }
}