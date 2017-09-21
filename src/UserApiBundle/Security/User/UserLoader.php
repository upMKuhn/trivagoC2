<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 8/22/17
 * Time: 8:05 PM
 */

namespace UserApiBundle\Security\User;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use UserApiBundle\Repository\UserRepository;

class UserLoader implements UserLoaderInterface
{

    private $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Loads the user for the given username.
     *
     * This method must return null if the user is not found.
     *
     * @param string $username The username
     *
     * @return UserInterface|null
     */
    public function loadUserByUsername($username)
    {
        return $this->userRepo->loadUserByUsername($username);
    }
}