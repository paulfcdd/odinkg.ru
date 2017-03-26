<?php

namespace AppBundle\Controller;

use AppBundle\Entity\{
    Image, Object, ServicePage
};
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Query\Expr\Join;

class SiteController extends Controller
{
    const OBJECT_TYPE = [
        'house' => 1,
        'plot' => 2
    ];

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="home")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        return $this->render('odinkg/front/index.html.twig', [
            'services' => $em->getRepository(ServicePage::class)->findAll()
        ]);
    }

    /**
     * @param $status
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/status/{status}", name="object.show_by_status")
     */
    public function showByStatusAction($status){

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(Object::class);

//        $objects = $em->createQueryBuilder('o')
//            ->leftJoin(Image::class, 'i', Join::WITH, 'i.foreignKey = o.id')
//            ->where('o.saleStatus = :status')
//            ->andWhere('i.entity = :entity')
//            ->setParameters([
//                'status' => Object::SALE_TYPE[$status],
//                'entity' => Object::class,
//            ])
//            ->getQuery();

        $objects = $this->getDoctrine()->getRepository(Object::class)->findBySaleStatus(Object::SALE_TYPE[$status]);

        return $this->render(':odinkg/front:objects_list.html.twig', [
            'objects' => $objects
        ]);
    }

    /**
     * @param $status
     * @param Object $object
     * @Route("/status/{status}/object/{object}", name="object.single")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSingleObjectAction($status, Object $object) {

        return $this->render(':odinkg/front:single_object.html.twig', [
            'object'=> $object,
        ]);
    }


//    public function saleAction()
//    {
//
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getRepository(Object::class);
//
//        $query = $em->createQueryBuilder('o')
//            ->where('o.saleStatus = :status')
//            ->andWhere('o.dateRemoved IS NULL')
//            ->setParameter('status', 1)
//            ->getQuery();
//
//        return $this->render('odinkg/front/sale.html.twig', [
//            'objects' => $query->getResult()
//        ]);
//    }
//
//    public function salesByTypeAction($type) {
//
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getRepository(Object::class);
//
//        $query = $em->createQueryBuilder('o')
//            ->where('o.saleStatus = :status')
//            ->andWhere('o.type = :type')
//            ->andWhere('o.dateRemoved IS NULL')
//            ->setParameter('type', self::OBJECT_TYPE[$type])
//            ->setParameter('status', 1)
//            ->getQuery();
//
//        return $this->render(':odinkg/front/sale:list_by_type.html.twig', [
//            'objects' => $query->getResult()
//        ]);
//    }
//
//    public function singleObjectViewAction(Object $object, $type)
//    {
//
//
//        return $this->render(':odinkg/front/sale:detail_view.html.twig', [
//            'object' => $object
//        ]);
//    }
//
//    public function contactAction()
//    {
//        return $this->render('odinkg/front/contact.html.twig');
//    }
//
//    public function rentAction()
//    {
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getRepository(Object::class);
//
//        $query = $em->createQueryBuilder('o')
//            ->where('o.saleStatus = :status')
//            ->andWhere('o.dateRemoved IS NULL')
//            ->setParameter('status', 2)
//            ->getQuery();
//
//        return $this->render('odinkg/front/rent.html.twig', [
//            'objects' => $query->getResult()
//        ]);
//    }
//
//    public function rentByTypeAction($type){
//
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getRepository(Object::class);
//
//        $query = $em->createQueryBuilder('o')
//            ->where('o.saleStatus = :status')
//            ->andWhere('o.type = :type')
//            ->andWhere('o.dateRemoved IS NULL')
//            ->setParameter('type', self::OBJECT_TYPE[$type])
//            ->setParameter('status', 2)
//            ->getQuery();
//
//        return $this->render(':odinkg/front/rent:list_by_type.html.twig', [
//            'objects' => $query->getResult()
//        ]);
//    }
//
//    public function singleObjectRentViewAction(Object $object, $type){
//
//    }
//
//    public function notFoundAction()
//    {
//        return $this->render('TwigBundle/views/Exception/error404.html.twig');
//    }
}