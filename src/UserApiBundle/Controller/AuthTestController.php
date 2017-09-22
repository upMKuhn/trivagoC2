<?php

namespace UserApiBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
class AuthTestController extends Controller
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
    public function testLoginAction($id, Request $request)
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
    }


}
