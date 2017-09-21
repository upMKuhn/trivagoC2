<?php

namespace UserApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Issue
 *
 * @ORM\Table(name="issue")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\IssueRepository")
 */
class Issue
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
     * @ORM\Column(name="Title", type="string", length=255)
     */
    private $title;

    /**
     * @var AdvancedUser
     * @ORM\ManyToOne(targetEntity="AdvancedUser")
     */
    private $creator;
    /**
     * @var string
     *
     * @ORM\Column(name="Location", type="string", length=255)
     */
    private $location;

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
     * @var IssueCategory
     * @ORM\ManyToOne(targetEntity="IssueCategory")
     */
    private $category;

    /**
     * @var IssuePriority
     * @ORM\ManyToOne(targetEntity="IssuePriority")
     */
    private $priority;

    /**
     * @var IssueState
     * @ORM\ManyToOne(targetEntity="IssueState")
     */
    private $state;

    /**
     * @var BuildingFloor
     * @ORM\ManyToOne(targetEntity="UserApiBundle\Entity\BuildingFloor", inversedBy="issues")
     *
     */
    private $floor;

    /**
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\IssueComment", mappedBy="issue", orphanRemoval=true)
     * @var IssueComment []
     */
    public  $comments = [];

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\IssueSubscription", mappedBy="issue", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $subscriptions = [];

    public function __construct()
    {
        $this->subscriptions =  new ArrayCollection();
    }

    public static function create($title, $location, AdvancedUser $creator, IssueCategory $category, IssuePriority $priority, BuildingFloor $floor, IssueState $state){
        $obj = new self();
        $obj->title = $title;
        $obj->location = $location;
        $obj->category = $category;
        $obj->priority = $priority;
        $obj->creator = $creator;
        $obj->state = $state;
        $obj->createdAt = new \DateTime();
        $obj->updatedAt = new \DateTime();
        $obj->floor = $floor;
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
     * Set title
     *
     * @param string $title
     *
     * @return Issue
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Issue
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Issue
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set updatedAt
     * @return Issue
     */
    public function onUpdated()
    {
        $this->updatedAt = new \DateTime();

        return $this;
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
     * @return BuildingFloor
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @return BuildingFloor
     */
    public function setFloor($obj)
    {
    }

    /**
     * @return IssuePriority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param IssuePriority $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return IssueCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param IssueCategory $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return IssueState
     */
    public function getState()
    {
        return $this->state;
    }


    /**
     * @return Collection
     */
    public function getSubscriptions(){
        return $this->subscriptions;
    }

    public function addSubscriber(IssueSubscription $subscriber){
        $this->subscriptions[$subscriber->getId()] = $subscriber;
    }

    /**
     * @param IssueState $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return IssueComment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return AdvancedUser
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return AdvancedUser
     */
    public function setCreator($obj)
    {
    }



}

