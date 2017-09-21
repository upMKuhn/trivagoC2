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
use UserApiBundle\Entity\Issue;
use UserApiBundle\Entity\IssueSubscription;
use UserApiBundle\Entity\User;

class IssueManipulationLister implements ManipulationListener
{
    /**
     * @var IssueMailingService
     */
    private $mailer;
    /**
     * @var Issue
     */
    private $issue;
    /**
     * @var int
     */
    private $oldState;
    /**
     * @var EntityManager
     */
    private $entityManager;
    public function __construct(IssueMailingService $mailer, EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->oldState = null;
    }


    /**
     * @param Issue $entity
     */
    public function beforeCreate($entity)
    {
        $this->mailer->onIssueCreated($entity);
    }

    /**
     * @param Issue $issue
     */
    public function beforeUpdate($issue)
    {
        $this->issue = $issue;
        $this->oldState = $issue->getState()->getId();

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
        $subscriber = IssueSubscription::create($issue->getCreator(), $issue);
        $this->mailer->onIssueCreated($issue);
        $this->entityManager->persist($subscriber);
        $this->entityManager->flush();
    }

    /**
     * @param Issue $issue
     */
    public function afterUpdate($issue)
    {
        $this->issue = $issue;
        $this->issue->onUpdated();
        if($this->oldState === $issue->getState()->getId())
        {
            $this->mailer->sendStateChangedMail($issue);
        }

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
        return $resourceName === 'issues';
    }

}