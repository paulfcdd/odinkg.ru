<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProjectController
 * @package AppBundle\Controller\Admin
 * @Route("/dashboard/project")
 */
class ProjectController extends Controller
{

    /**
     * @Route("", name="admin.project.list")
     */
    public function listProjectAction() {

        return $this->render(':odinkg/admin/project:project_list.html.twig', [
            'projects' => $this->getDoctrine()->getRepository(Project::class)->findAll()
        ]);
    }

    /**
     * @param Project|null $project
     * @param Request $request
     * @return Response
     * @Route("/manage/{project}", name="admin.project.manage")
     */
    public function manageProjectAction(Project $project = null, Request $request) {

        $form = $this
            ->createForm(ProjectType::class, $project)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $crudable = $this
                ->get('app.crudable')
                ->setData($form)
                ->setUploadDir('projects');

            return $this->redirectToRoute('admin.project.manage', [
                'project' => $crudable->save(),
            ]);
        }

        return $this->render(':odinkg/admin/project:project_manage.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    /**
     * @param Project $project
     * @return Response
     * @Route("/delete/{project}", name="admin.project.delete")
     */
    public function deleteProjectAction(Project $project) {

        return $this
            ->get('app.crudable')
            ->setData($project)
            ->delete();
    }

    /**
     * @Route("/bin", name="admin.project.bin")
     */
    public function projectBinAction() {

        /** @var EntityRepository $em */
        $em = $this->getDoctrine()->getRepository(Project::class);

        $query = $em->createQueryBuilder('p')
            ->where('.dateRemoved IS NOT NULL')
            ->getQuery();

        return $this->render('odinkg/admin/project/project_bin.html.twig', [
            'objects' => $query->getResult(),
            'entity' => Project::class,
        ]);
    }

}