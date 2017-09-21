<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 9/20/17
 * Time: 5:46 PM
 */

namespace UserApiBundle\Entity;


use Symfony\Component\Security\Core\User\AdvancedUserInterface;

interface ISubscription
{
    /**
     * @return AdvancedUserInterface
     */
    public function getSubscriber();
}