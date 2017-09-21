<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 8/23/17
 * Time: 12:48 PM
 */

namespace UserApiBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Trivago\Jade\Application\JsonApi\Request\CollectionRequest;
use Trivago\Jade\Application\JsonApi\Request\CreateRequest;
use Trivago\Jade\Application\JsonApi\Request\DeleteRequest;
use Trivago\Jade\Application\JsonApi\Request\EntityRequest;
use Trivago\Jade\Application\JsonApi\Request\UpdateRequest;
use Trivago\Jade\Application\Listener\ManipulationListener;
use Trivago\Jade\Application\Listener\RequestListener;
use UserApiBundle\Entity\Comment;
use UserApiBundle\Entity\Issue;
use UserApiBundle\Entity\IssueComment;
use UserApiBundle\Entity\User;

class CommentManipulationLister implements ManipulationListener
{

    private $mailer;
    public function __construct(IssueMailingService $mailer, EntityManager $entityManager)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param IssueComment $entity
     */
    public function beforeCreate($entity)
    {
        $entity->onCreated();
        $entity->onUpdated();
        // TODO: Implement beforeCreate() method.
    }

    /**
     * @param IssueComment $issue
     * @internal param Comment $entity
     */
    public function beforeUpdate($issue)
    {
        $issue->onUpdated();
    }

    /**
     * @param object $entity
     */
    public function beforeDelete($entity)
    {
        // TODO: Implement beforeDelete() method.
    }

    /**
     * @param IssueComment $entity
     */
    public function afterCreate($entity)
    {
        $this->mailer->onCommentAdded($entity);
    }

    /**
     * @param object $entity
     */
    public function afterUpdate($entity)
    {
        // TODO: Implement afterUpdate() method.
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
        return $resourceName === 'issueComments';
    }
}