<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 8/23/17
 * Time: 12:48 PM
 */

namespace UserApiBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Trivago\Jade\Application\JsonApi\Request\CollectionRequest;
use Trivago\Jade\Application\JsonApi\Request\CreateRequest;
use Trivago\Jade\Application\JsonApi\Request\DeleteRequest;
use Trivago\Jade\Application\JsonApi\Request\EntityRequest;
use Trivago\Jade\Application\JsonApi\Request\UpdateRequest;
use Trivago\Jade\Application\Listener\ManipulationListener;
use Trivago\Jade\Application\Listener\RequestListener;
use UserApiBundle\Entity\Issue;
use UserApiBundle\Entity\IssueSubscription;
use UserApiBundle\Entity\ISubscription;
use UserApiBundle\Entity\User;

class SubscriptionManipulationLister implements ManipulationListener
{

    /**
     * @var User
     */
    private $user;

    /**
     * SubscriptionManipulationLister constructor.
     * @param TokenStorage $token
     */
    public function __construct(TokenStorage $token)
    {
        $this->user = $token->getToken()->getUser();
    }


    /**
     * @param $entity
     */
    public function beforeCreate($entity)
    {
    }

    /**
     * @param Issue $issue
     */
    public function beforeUpdate($issue)
    {
    }

    /**
     * @param object $entity
     */
    public function beforeDelete($entity)
    {
    }

    /**
     * @param Issue $issue
     */
    public function afterCreate($issue)
    {
    }

    /**
     * @param Issue $issue
     */
    public function afterUpdate($issue)
    {

    }

    /**
     * @param mixed $entityId
     */
    public function afterDelete($entityId)
    {
        // TODO: Implement afterDelete() method.
    }

    /**
     * @param string $resourceName
     * @return bool
     */
    public function supports($resourceName)
    {
        return in_array($resourceName, array('issueSubscribers','floorSubscriptions'));
    }

}