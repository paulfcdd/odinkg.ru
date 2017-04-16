<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\File;
use AppBundle\Entity\Object;
use AppBundle\Form\ObjectType;
use AppBundle\Service\FileUploader;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ObjectController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/dashboard/object", name="admin.object")
     */
    public function listObjectAction(){

        return $this->render(':odinkg/admin/object:list.html.twig',[
            'objects' => $this->getDoctrine()->getRepository(Object::class)->findAll(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/dashboard/object/add", name="admin.object.add")
     */
    public function addObjectAction(Request $request){

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $form = $this
            ->createForm(ObjectType::class)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($form->getData()
                ->setDateCreated(new \DateTime())
            );

           $em->flush();

            return $this->redirectToRoute('admin.object');
        }

        return $this->render(':odinkg/admin/object:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Object $object
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/dashboard/object/{object}/edit", name="admin.object.edit")
     */
    public function editObjectAction(Object $object, Request $request) {

        /** @var EntityManager $em */
        $em = $this
            ->getDoctrine()
            ->getManager();

        $form = $this
            ->createForm(ObjectType::class)
            ->setData($object)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form['photos']->getData()) {

                foreach ($form['photos']->getData() as $photo) {

                    $fileName = trim(strtolower(str_replace(' ', '_', ($photo['name']))));

                    $uploader = $this->get('app.file_uploader')
                        ->setDir('objects')
                        ->setFile($photo['file'])
                        ->setFileName($fileName)
                        ->upload();

                    if ($uploader) {
                        $image = new File();
                        $image
                            ->setForeignKey($object->getId())
                            ->setEntity(Object::class)
                            ->setName($fileName.'.'.$photo['file']->getClientOriginalExtension())
                            ->setDescription($photo['description'])
                            ->setAlt(trim($photo['alt']))
                            ->setTitle(trim($photo['title']));
                        $em->persist($image);
                    }
                }
            }

            $form
                ->getData()
                ->setDateUpdated(new \DateTime());

            $em->flush();

            return $this->redirectToRoute('admin.object');
        }

        $images = $em->createQueryBuilder()
            ->select('i')
            ->from(File::class, 'i')
            ->where('i.entity = :entity')
            ->andWhere('i.foreignKey = :foreignKey')
            ->setParameters([
                'entity' => Object::class,
                'foreignKey' => $object->getId()
            ])
            ->getQuery();

        return $this->render(':odinkg/admin/object:add.html.twig', [
            'form' => $form->createView(),
            'images' => $images->getResult(),
        ]);
    }

    /**
     * @param Request $request
     * @param Object $object
     * @return JsonResponse
     * @Route("/dashboard/object/delete/{object}", name="admin.object.delete")
     */
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