<?php

namespace UserApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FloorSubscription
 *
 * @ORM\Table(name="floor_subscription")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\FloorSubscriptionRepository")
 */
class FloorSubscription implements ISubscription
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
     * @var BuildingFloor
     * @ORM\ManyToOne(targetEntity="UserApiBundle\Entity\BuildingFloor", inversedBy="subscriptions", cascade={"persist"})
     * @ORM\JoinColumn(name="floor_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $floor;

    /**
     * @var BuildingFloor
     * @ORM\ManyToOne(targetEntity="UserApiBundle\Entity\AdvancedUser", cascade={"persist"})
     * @ORM\JoinColumn(name="subscriber_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $subscriber;

    /**
     * @param AdvancedUser $subscriber
     * @param BuildingFloor $floor
     * @return FloorSubscription
     */
    public static function create(AdvancedUser $subscriber, BuildingFloor $floor){
        $obj = new self();
        $obj->floor = $floor;
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
     * @return BuildingFloor
     */
    public function getFloor()
    {
        return $this->floor;
    }


    /**
     * @return AdvancedUser
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }
}

