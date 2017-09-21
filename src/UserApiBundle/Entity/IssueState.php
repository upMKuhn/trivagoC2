<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IssueState
 *
 * @ORM\Table(name="issue_state")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\IssueStateRepository")
 */
class IssueState
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
     * @var integer
     *
     * @ORM\Column(name="asNumber", type="integer", unique=true)
     */
    private $asNumber;


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
     * Get name
     *
     * @return string
     */
    public function getAsNumber()
    {
        return $this->asNumber;
    }
}

