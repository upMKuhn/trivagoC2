<?php

namespace UserApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserApiBundle\Repository\UserRepository;




class DefaultController extends Controller
{


    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('UserApiBundle:Default:index.html.twig');
    }

}
