<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Route, Method
};

class WidgetController extends Controller
{
    public function footerProjectsWidgetAction() {

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getRepository(Project::class);

        $qb = $em->createQueryBuilder('p')
            ->setMaxResults(6)
            ->getQuery();


        return $this->render(':odinkg/front/widget:footer_projects.html.twig', [
            'projects' => $qb->getResult()
        ]);

    }
}