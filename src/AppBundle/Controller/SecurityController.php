<?php
namespace AppBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as FOSController;

class SecurityController extends FOSController {

    /**
     * @param array $data
     * @return mixed
     */
    public function renderLogin(array $data)
    {

//        var_dump($this->get('request_stack')->getCurrentRequest()->attributes->get('_route'));
//        die;
        if('fos_user_security_login' === $this->get('request_stack')->getCurrentRequest()->attributes->get('_route')) {
            $template = 'FOSUserBundle/views/Security/login.html.twig';
        } else {
            $template = 'FOSUserBundle::Security::login.html.twig';
        }

        return $this->get('templating')->renderResponse($template, $data);
    }
}