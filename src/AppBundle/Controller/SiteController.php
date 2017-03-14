<?php

namespace AppBundle\Controller;


use AppBundle\Entity\{
    Object, ServicePage
};
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;

class SiteController extends Controller
{

    const OBJECT_TYPE = [
        'house' => 1,
        'plot' => 2
    ];

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        return $this->render('odinkg/front/index.html.twig', [
            'services' => $em->getRepository(ServicePage::class)->findAll()
        ]);
    }

    public function saleAction()
    {

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(Object::class);

        $query = $em->createQueryBuilder('o')
            ->where('o.saleStatus = :status')
            ->andWhere('o.dateRemoved IS NULL')
            ->setParameter('status', 1)
            ->getQuery();

        return $this->render('odinkg/front/sale.html.twig', [
            'objects' => $query->getResult()
        ]);
    }

    public function salesByTypeAction($type) {

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(Object::class);

        $query = $em->createQueryBuilder('o')
            ->where('o.saleStatus = :status')
            ->andWhere('o.type = :type')
            ->andWhere('o.dateRemoved IS NULL')
            ->setParameter('type', self::OBJECT_TYPE[$type])
            ->setParameter('status', 1)
            ->getQuery();

        return $this->render(':odinkg/front/sale:list_by_type.html.twig', [
            'objects' => $query->getResult()
        ]);
    }

    public function singleObjectViewAction(Object $object, $type)
    {


        return $this->render(':odinkg/front/sale:detail_view.html.twig', [
            'object' => $object
        ]);
    }

    public function contactAction()
    {
        return $this->render('odinkg/front/contact.html.twig');
    }

    public function rentAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(Object::class);

        $query = $em->createQueryBuilder('o')
            ->where('o.saleStatus = :status')
            ->andWhere('o.dateRemoved IS NULL')
            ->setParameter('status', 2)
            ->getQuery();

        return $this->render('odinkg/front/rent.html.twig', [
            'objects' => $query->getResult()
        ]);
    }

    public function rentByTypeAction($type){

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(Object::class);

        $query = $em->createQueryBuilder('o')
            ->where('o.saleStatus = :status')
            ->andWhere('o.type = :type')
            ->andWhere('o.dateRemoved IS NULL')
            ->setParameter('type', self::OBJECT_TYPE[$type])
            ->setParameter('status', 2)
            ->getQuery();

        return $this->render(':odinkg/front/rent:list_by_type.html.twig', [
            'objects' => $query->getResult()
        ]);
    }

    public function singleObjectRentViewAction(Object $object, $type){

    }

    public function notFoundAction()
    {
        return $this->render('TwigBundle/views/Exception/error404.html.twig');
    }
}