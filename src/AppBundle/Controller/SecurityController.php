<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/mlogin", name="mlogin")
     * @param Request $request
     * @param AuthenticationUtils $authUtil
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtil)
    {
        $lastError = $authUtil->getLastAuthenticationError();
        $lastUsername = $authUtil->getLastUsername();

        return $this->render('AppBundle:SecuirtyController:login.html.twig', array(
            'LastError' => $lastError,
            'last_username' => $lastUsername
        ));
    }

}
