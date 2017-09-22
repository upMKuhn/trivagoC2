<?php

namespace UserApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use UserApiBundle\Repository\UserRepository;




class DefaultController extends Controller
{


    private $fileSys;
    public function __construct()
    {
        $this->fileSys = new Filesystem();
    }

    /**
     * @Route("/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('UserApiBundle:Default:index.html.twig');
    }

    /**
     * @param Request $request
     * @return null|Response
     */
    public function directToAngularAction(Request $request)
    {
         $file = new File('assets' . $request->getRequestUri());
         $content = $file->openFile('r')->fread($file->getSize());
         return new Response($content, 200);
    }


    private function canRedirectToFile(){

    }

}
