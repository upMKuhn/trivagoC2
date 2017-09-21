<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FloorSection
 *
 * @ORM\Table(name="floor_section")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\FloorSectionRepository")
 */
class FloorSection
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
     * @ORM\Column(name="SectionName", type="string", length=255)
     */
    private $sectionName;


    /* @var Building
     * @ORM\OneToMany(targetEntity="UserApiBundle\Entity\BuildingFloor", mappedBy="building", orphanRemoval=true)
     */
    private $floor;

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
     * Set sectionName
     *
     * @param string $sectionName
     *
     * @return FloorSection
     */
    public function setSectionName($sectionName)
    {
        $this->sectionName = $sectionName;

        return $this;
    }

    /**
     * Get sectionName
     *
     * @return string
     */
    public function getSectionName()
    {
        return $this->sectionName;
    }

    public static function create($sectionName){
        $obj = new self();
        $obj->sectionName = $sectionName;
        return $obj;
    }
}

