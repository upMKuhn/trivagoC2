<?php

namespace UserApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingFloor
 *
 * @ORM\Table(name="building_floor", uniqueConstraints={@ORM\UniqueConstraint(name="floorNameNumber", columns={"floorNumber", "floorName"})})
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\FloorSubscriptionRepository")
 */
class BuildingFloor
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
     * @var int
     * @ORM\Column(name="floorNumber", type="integer")
     */
    private $floorNumber;

    /**
     * @var string
     * @ORM\Column(name="floorName", type="string", length=255)
     */
    private $floorName;


    /**
     * @var Building
     * @ORM\ManyToOne(targetEntity="UserApiBundle\Entity\Building", inversedBy="floors")
     *
     */
    private $building;

    /**
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\Issue", mappedBy="floor", orphanRemoval=true)
     * @var Issue []
     */
    public  $issues = [];

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\FloorSubscription", mappedBy="floor", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $subscriptions = [];

    public static function create($floorNumber, $floorName){

        $obj = new self();
        $obj->floorNumber = $floorNumber;
        $obj->floorName = $floorName;
        $obj->subscriptions = new ArrayCollection();
        return $obj;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return  $this->id;
    }

    public function getFloorName()
    {
        return  $this->floorName;
    }

    /**
     * @return \UserApiBundle\Entity\Building
     */
    public function getBuilding(){
        return $this->building;
    }

    /**
     * @param $building
     */
    public function setBuilding($building){
        $this->building = $building;
    }


    /**
     * Set floorNumber
     *
     * @param integer $floorNumber
     *
     * @return BuildingFloor
     */
    public function setFloorNumber($floorNumber)
    {
        $this->floorNumber = $floorNumber;
        return $this;
    }

    /**
     * Get floorNumber
     *
     * @return int
     */
    public function getFloorNumber()
    {
        return $this->floorNumber;
    }



    public function __toString()
    {
        return json_encode($this);
    }

    /**
     * @return Issue[]
     */
    public function getIssues()
    {
        return $this->issues;
    }

    /**
     * @return FloorSubscription[]
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }
}

