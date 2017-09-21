<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Comment
 *
 * @ORM\Table(name="issue_comment")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\CommentRepository")
 */
class IssueComment
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
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var AdvancedUser
     * @ORM\ManyToOne(targetEntity="AdvancedUser")
     */
    private $author;

    /**
     * @var Issue
     * @ORM\ManyToOne(targetEntity="Issue")
     */
    private $issue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;


    /**
     * @param $text
     * @param $author AdvancedUser
     * @param $issue Issue
     * @return IssueComment
     */
    public static function create($text, $author, Issue $issue)
    {
        $obj = new self();
        $obj->text = $text;
        $obj->author = $author;
        $obj->issue = $issue;
        $obj->createdAt = new \DateTime("now");
        $obj->updatedAt = new \DateTime("now");
        return $obj;
    }

    /**
     * Set updatedAt
     * @return IssueComment
     */
    public function onUpdated()
    {
        $this->updatedAt = new \DateTime();

        return $this;
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
     * Set text
     *
     * @param string $text
     *
     * @return IssueComment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    public function setCreatedAt($createdAt){}

    /**
     * on createdAt
     * @return IssueComment
     */
    public function onCreated()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * Set updatedAt
     *
     * @param AdvancedUser $author
     *
     * @return IssueComment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return AdvancedUser
     */
    public function getAuthor()
    {
        return $this->author;
    }


    /**
     * Get author
     *
     * @return Issue
     */
    public function getIssue()
    {
        return $this->issue;
    }
}

