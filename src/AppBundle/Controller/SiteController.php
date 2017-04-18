<?php

namespace AppBundle\Controller;

use AppBundle\Entity\{
    Contact, File, Object, Project, ServicePage
};
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Query\Expr\Join;

class SiteController extends Controller
{

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

        $objects = $this->getDoctrine()->getRepository(Object::class)->findBySaleStatus(Object::SALE_TYPE[$status]);

        return $this->render(':odinkg/front/object:objects_list.html.twig', [
            'objects' => $objects,
            'status' => $status
        ]);
    }

    /**
     * @Route("/status/{status}/type/{type}", name="object.show_by_type")
     */
    public function showByTypeAction($status, $type) {
        $objects = $this->getDoctrine()->getRepository(Object::class)->findBy([
           'saleStatus' =>  Object::SALE_TYPE[$status],
            'type' => Object::TYPE[$type]
        ]);

        return $this->render(':odinkg/front/object:objects_list.html.twig', [
            'objects' => $objects,
            'contact' => $this->getDoctrine()->getRepository(Contact::class)->findAll(),
            'status' => $status,
            'type' => $type
        ]);
    }

    /**
     * @param $status
     * @param Object $object
     * @Route("/status/{status}/object/{object}", name="object.single")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getSingleObjectAction($status, Object $object) {

        return $this->render(':odinkg/front/object:object_single.html.twig', [
            'object'=> $object,
            'status' => $status
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('odinkg/front/contact.html.twig');
    }

    /**
     * @Route("/project/list", name="project.list")
     */
    public function showProjectListAction(){
        return $this->render(':odinkg/front/project:project_list.html.twig', [
            'projects' => $this->getDoctrine()->getRepository(Project::class)->findAll(),
        ]);
    }

    /**
     * @param Project $project
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/project/id{project}", name="project.single")
     */
    public function singleProjectAction(Project $project) {

        $prevPost = $this->getDoctrine()->getRepository(Project::class)->find($project->getId() - 1);

        $nextPost = $this->getDoctrine()->getRepository(Project::class)->find($project->getId() + 1);

        return $this->render(':odinkg/front/project:project_single.html.twig', [
            'project' => $project,
            'prevPost' => $prevPost,
            'nextPost' => $nextPost,
        ]);
    }
}