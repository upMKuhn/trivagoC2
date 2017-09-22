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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use UserApiBundle\Entity\AdvancedUser;
use UserApiBundle\Entity\User;
use UserApiBundle\Repository\UserRepository;
use UserApiBundle\Security\User\UserProvider;

/**
 * Class AuthTestController
 * @package UserApiBundle\Controller
 * @Route("api/",service="UserApiBundle.AuthTest")
 */
class LoginTestController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repo;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->repo = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }


    /**
     * @Route("login/{id}")
     * @param Request $request
     * @return JsonResponse
     */
<<<<<<< HEAD:src/UserApiBundle/Controller/AuthTestController.php
    public function testLoginAction($id, Request $request)
=======
    public function loginTestAction($id, Request $request)
>>>>>>> UserRegister:src/UserApiBundle/Controller/LoginTestController.php
    {
        $data = $this->repo->loadUserByUsername($id);
        return new JsonResponse($data->serialize(), 200, array(), true);
    }

<<<<<<< HEAD:src/UserApiBundle/Controller/AuthTestController.php

    /**
     * @Route("register")
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request){
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $user = AdvancedUser::create($data['username'], $data['password'], $data['email']);
            $user->ensurePasswordEncoded(function ($plainPassword) use ($user) {
                return $this->passwordEncoder->encodePassword($user, $plainPassword);
            });
            $this->repo->save($user);
            return new JsonResponse($user->serialize());
        }
=======
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
>>>>>>> UserRegister:src/UserApiBundle/Controller/LoginTestController.php
    }


}
