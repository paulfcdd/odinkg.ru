<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Object;
use AppBundle\Form\ObjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ObjectController extends Controller
{
    public function listObjectAction(){

        return $this->render(':odinkg/admin/object:list.html.twig',[
            'objects' => $this->getDoctrine()->getRepository(Object::class)->findAll(),
        ]);
    }

    public function addObjectAction(Request $request){

        $form = $this->createForm(ObjectType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $em = $this->getDoctrine()->getManager();
           $em->persist($form->getData()->setDateCreated(
               \DateTime::createFromFormat('d.m.Y', date('d.m.Y'))
           ));
           $em->flush();

            return $this->redirectToRoute('admin.object');
        }

        return $this->render(':odinkg/admin/object:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    public function editObjectAction(Object $object, Request $request) {

        $form = $this->createForm(ObjectType::class);

        $form->setData($object);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $form->getData()->setDateUpdated(
                \DateTime::createFromFormat('d.m.Y', date('d.m.Y'))
            );
            $em->flush();

            return $this->redirectToRoute('admin.object');
        }

        return $this->render(':odinkg/admin/object:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function deleteObjectAction(Request $request, Object $object){
        if ($request->isMethod('post')) {
            $em = $this->getDoctrine()->getManager();
            $object->setDateremoved(
                \DateTime::createFromFormat('d.m.Y', date('d.m.Y'))
            );
            $em->flush();
            return JsonResponse::create($object->getId(), 200);
        }

    }
}