<?php
namespace AppBundle\Controller\Admin;


use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ContactController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/contact", name="admin.contact")
     */
    public function manageAction() {

        $form = $this->createForm(ContactType::class);

        return $this->render('odinkg/admin/contacts/manage.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}