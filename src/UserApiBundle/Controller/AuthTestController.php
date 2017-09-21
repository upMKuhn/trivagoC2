<?php

namespace UserApiBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
class AuthTestController extends Controller
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
    public function adminAction($id, Request $request)
    {
        $data = $this->repo->loadUserByUsername($id);
        return new JsonResponse($data->serialize(), 200, array(), true);
        /**
        return new JsonResponse(array(
            'id' => $data->getId(),
            'username' => $data->getUsername(),
            'email' => $data->getEmail(),
            'rolesAsInt' => $data->getRoleAsInt(),
        ),200 , array(), true);
         */
    }

}
