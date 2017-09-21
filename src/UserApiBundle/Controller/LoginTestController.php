<?php

namespace UserApiBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserApiBundle\Entity\User;
use UserApiBundle\Repository\UserRepository;
use UserApiBundle\Security\User\UserProvider;

/**
 * Class AuthTestController
 * @package UserApiBundle\Controller
 * @Route("api/login/",service="UserApiBundle.AuthTest")
 */
class LoginTestController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repo;
    public function __construct(UserRepository $repository)
    {
        $this->repo = $repository;
    }


    /**
     * @Route("{id}")
     * @param Request $request
     * @return JsonResponse
     */
    public function loginTestAction($id, Request $request)
    {
        $data = $this->repo->loadUserByUsername($id);
        return new JsonResponse($data->serialize(), 200, array(), true);
    }

    /**
     * @Route("\api\register\")
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Method({"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function registerAction(Request $request)
    {
        $response = new JsonResponse("Try it with a request body", 400, array(), true);
        $body = $request->getContent();
        if(!empty($body)){
            $body = json_decode($body, true);
            $user = User::create($body['username'], $body['password'], $body['email']);
            $this->repo->
            $response = new JsonResponse($user->serialize(), 200, array(), true);
        }

        return $response;
    }


}
