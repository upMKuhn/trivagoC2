<?php

namespace AppBundle\Controller;

use FOS\UserBundle\FOSUserBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {


        // replace this example code with whatever you need
        return $this->render('AppBundle:DefaultController:index.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    /**
     * @Route("/info", name="info")
     * @param Request $request
     * @return null
     */
    public function infoAction(Request $request)
    {
        echo phpinfo();
    }
}
