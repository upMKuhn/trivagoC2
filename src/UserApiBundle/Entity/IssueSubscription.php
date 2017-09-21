<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IssueSubscription
 *
 * @ORM\Table(name="issue_subscription")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\IssueSubscriptionRepository")
 */
class IssueSubscription implements  ISubscription
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var AdvancedUser
     * @ORM\ManyToOne(targetEntity="UserApiBundle\Entity\AdvancedUser")
     * @ORM\JoinColumn(name="subscriber_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $subscriber;

    /**
     * @var Issue
     * @ORM\ManyToOne(targetEntity="UserApiBundle\Entity\Issue", inversedBy="subscriptions", cascade={"persist"})
     * @ORM\JoinColumn(name="issue_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $issue;

    /**
     * @param AdvancedUser $subscriber
     * @param Issue $issue
     * @return IssueSubscription
     */
    public static function create(AdvancedUser $subscriber, Issue $issue){
        $obj = new self();
        $obj->issue = $issue;
        $obj->subscriber = $subscriber;
        return $obj;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Issue
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * @return user
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

}

