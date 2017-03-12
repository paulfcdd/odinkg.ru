<?php
namespace AppBundle\Controller\Admin;


use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function manageAction() {

        $form = $this->createForm(ContactType::class);

        return $this->render('odinkg/admin/contacts/manage.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}