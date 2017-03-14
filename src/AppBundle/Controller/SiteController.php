<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Object;
use AppBundle\Entity\ServicePage;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;

class SiteController extends Controller
{
    public function indexAction(){

       $em = $this->getDoctrine()->getManager();

       return $this->render('odinkg/front/index.html.twig',[
		    'services' => $em->getRepository(ServicePage::class)->findAll()
        ]);
	}

	public function saleAction(){

//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getRepository(Object::class);
//
//        $query = $em->createQueryBuilder('o')
//            ->where('o.dateRemoved IS NOT NULL')
//            ->andWhere('o.status = :status')
//            ->setParameter('status', 1)
//            ->getQuery();

	    return $this->render('odinkg/front/sale.html.twig', [
	        'objects' => $this->getDoctrine()->getRepository(Object::class)->findAll()
        ]);
    }

    public function contactAction(){
	    return $this->render('odinkg/front/contact.html.twig');
    }

    public function rentAction(){
        return $this->render('odinkg/front/rent.html.twig');
    }

    public function notFoundAction(){
        return $this->render('TwigBundle/views/Exception/error404.html.twig');
    }
}