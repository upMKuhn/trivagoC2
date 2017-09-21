<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IssuePriority
 *
 * @ORM\Table(name="issue_priority")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\IssuePriorityRepository")
 */
class IssuePriority
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
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="needToActionValue", type="integer", unique=true)
     */
    private $needToActionValue;


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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get needToActionValue
     *
     * @return int
     */
    public function getNeedToActionValue()
    {
        return $this->needToActionValue;
    }
}

