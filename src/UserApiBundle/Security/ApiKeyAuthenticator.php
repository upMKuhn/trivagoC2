<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 9/13/17
 * Time: 10:04 AM
 */

namespace UserApiBundle\Security;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use UserApiBundle\Repository\UserRepository;


class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface
{




    /**
     * @var UserRepository
     */
    private $userLoader;
    public function constructor(UserRepository $repo){
        $this->userLoader = $repo;
    }

    public function createToken(Request $request, $providerKey)
    {
        $apiKey = $request->headers->get('apikey');

        if(!$apiKey)
            throw new BadCredentialsException();

        $user = $this->userLoader->loadUserApiKey($apiKey);

        return new PreAuthenticatedToken($user, $apiKey, $providerKey);
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        // TODO: Implement authenticateToken() method.
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }


}