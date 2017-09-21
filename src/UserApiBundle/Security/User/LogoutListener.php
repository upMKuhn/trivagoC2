<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 8/23/17
 * Time: 3:06 PM
 */

namespace UserApiBundle\Security\User;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class LogoutListener implements LogoutSuccessHandlerInterface
{

    /**
     * Creates a Response object to send upon a successful logout.
     *
     * @param Request $request
     *
     * @return Response never null
     */
    public function onLogoutSuccess(Request $request)
    {
        return new Response('', 401);
    }
}