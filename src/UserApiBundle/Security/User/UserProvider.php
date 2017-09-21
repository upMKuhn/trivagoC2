<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 8/22/17
 * Time: 4:12 PM
 */

namespace UserApiBundle\Security\User;


use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserApiBundle\Entity\User;
use UserApiBundle\Repository\UserRepository;

class UserProvider implements UserProviderInterface
{

    private $usersLoader;

    /**
     * WebServiceUserProvider constructor.
     * @param UserLoaderInterface $userLoader
     * @internal param UserRepository $userRepo
     */
    public function __construct(UserLoaderInterface $userLoader)
    {
        echo 'hello!';
        $this->usersLoader = $userLoader;
    }

    public function loadUserByUsername($username)
    {
        return $this->usersLoader->loadUserByUsername($username);
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return User::class  === $class;
    }
}