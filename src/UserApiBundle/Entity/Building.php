<?php

namespace UserApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\PersistentCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\BuildingRepository")
 * @UniqueEntity("name")
 */
class Building
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $buildingName;

    /**
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\BuildingFloor", mappedBy="building", orphanRemoval=true)
     * @var BuildingFloor []
     */
    public  $floors = [];

    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     *
     * @return Building
     */
    public function setBuildingName($name)
    {
        $this->buildingName = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getBuildingName()
    {
        return $this->buildingName;
    }

    /**
     * @param array $floors
     */
    public function setFloors($floors)
    {
        $this->floors = $floors;
    }

    /**
     * @return BuildingFloor[]
     */
    public function getFloors(){
        return $this->floors;
    }

    public function addFloor(BuildingFloor $floor){
        $this->floors->add($floor);
    }

    /**
     * @param $name
     * @return Building
     */
    static function create($buildingName){
        $obj = new self();
        $obj->buildingName = $buildingName;
        return $obj;
    }


}

