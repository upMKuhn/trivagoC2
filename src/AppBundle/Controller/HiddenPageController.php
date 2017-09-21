<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HiddenPageController extends Controller
{
    /**
     * @Route("/hiddenPage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:HiddenPage:index.html.twig', array(
            // ...
        ));
    }

}
