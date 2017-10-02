<?php

namespace UserApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserApiBundle\Repository\UserRepository;




class DefaultController extends Controller
{


    private $fileSys;
    public function __construct()
    {
        $this->fileSys = new Filesystem();
    }


    /**
     * @param Request $request
     * @return null|Response
     */
    public function directToAngularAction(Request $request)
    {
        $path = 'assets' . $request->getRequestUri();

        if(is_file($path)) {
            return $this->redirect($path);

        } else {
            $file = new File('assets/index.html');
            $content = $file->openFile('r')->fread($file->getSize());
            return new Response($content, 200);
        }
    }


    private function canRedirectToFile(){

    }

}
