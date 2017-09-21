<?php
/**
 * Created by PhpStorm.
 * User: mkuhn
 * Date: 9/14/17
 * Time: 2:30 PM
 */

namespace UserApiBundle\Services;


use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Templating\EngineInterface;
use UserApiBundle\Entity\FloorSubscription;
use UserApiBundle\Entity\Issue;
use UserApiBundle\Entity\IssueComment;
use UserApiBundle\Entity\IssueSubscription;
use UserApiBundle\Repository\FloorSubscriptionRepository;
use UserApiBundle\Repository\IssueSubscriptionRepository;

class IssueMailingService
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var IssueSubscriptionRepository
     */
    private $issueSubscriptionRepo;
    /**
     * @var FloorSubscriptionRepository
     */
    private $floorSubscriptionRepo;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, IssueSubscriptionRepository $issueSubscriptionRepo, FloorSubscriptionRepository $floorSubscriptionRepo)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->issueSubscriptionRepo = $issueSubscriptionRepo;
        $this->floorSubscriptionRepo = $floorSubscriptionRepo;
    }

    public function sendStateChangedMail(Issue $issue){
        $subject = 'ISSUE: "'. $issue->getTitle() . '" has new state ' . $issue->getState()->getName();
        $message = new \Swift_Message($subject);
        $body = $this->templating->render('UserApiBundle:IssueMail:issue_state_changed.html.twig');
        $message->setBody($body,'text/html');
        $message->setTo($this->subscribersToMailList($issue));
        $success = $this->mailer->send($message, $failures);
    }

    public function onCommentAdded(IssueComment $comment){
        $author = $comment->getAuthor()->getUsername();
        $issue = $comment->getIssue();
        $subject = $author . ' commented on issue: ' . $issue->getTitle();
        $message = new \Swift_Message($subject);
        $body = $this->templating->render('UserApiBundle:IssueMail:issue_commented.html.twig', array( 'comment' => $comment));
        $message->setBody($body,'text/html');
        $message->setTo($this->subscribersToMailList($issue));
        $success = $this->mailer->send($message, $failures);
    }

    public function onIssueCreated(Issue $issue){
        $subject = $issue->getCreator()->getUsername() . ' commented on issue: ' . $issue->getTitle();
        $message = new \Swift_Message($subject);
        $body = $this->templating->render('UserApiBundle:IssueMail:new_issue.html.twig', array( 'issue' => $issue));
        $message->setBody($body,'text/html');
        $message->setTo($this->subscribersToMailList($issue));
        $success = $this->mailer->send($message, $failures);
    }

    /**
     * @param Issue $issue
     * @return array
     */
    private function subscribersToMailList(Issue $issue)
    {
        $issueSubscribers =  array_map(function(IssueSubscription $subscription){
            return $subscription->getSubscriber()->getEmail();
        }, $this->issueSubscriptionRepo->getSubscriptionsByIssue(($issue)));

        $floorSubscribers = array_map(function(FloorSubscription $subscription){
            return $subscription->getSubscriber()->getEmail();
        }, $this->floorSubscriptionRepo->getSubscriptionsByFloor($issue->getFloor()));

        return array_unique(array_merge($issueSubscribers, $floorSubscribers));
    }
}