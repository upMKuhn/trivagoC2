<?php

namespace UserApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IssueCategory
 *
 * @ORM\Table(name="issue_category")
 * @ORM\Entity(repositoryClass="UserApiBundle\Repository\IssueCategoryRepository")
 */
class IssueCategory
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
    private $categoryName;


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
    public function getCategoryName()
    {
        return $this->categoryName;
    }
}

