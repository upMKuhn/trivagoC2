<?php

namespace UserApiBundle\Repository;
use UserApiBundle\Entity\Issue;

/**
 * IssueSubscriptionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IssueSubscriptionRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param Issue $issue
     * @return array
     */
    public function getSubscriptionsByIssue(Issue $issue){
        return $this->findBy(array(
            'issue' => $issue->getId()
        ));
    }

}
