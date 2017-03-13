<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Object;
use AppBundle\Form\ObjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        }

        return $this->render(':odinkg/admin/object:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}