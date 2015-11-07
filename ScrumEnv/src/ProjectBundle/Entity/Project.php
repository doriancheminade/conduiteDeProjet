<?php
namespace ProjectBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Project
{
     /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */ 
    private $id;
    
    /**
     * @ORM\Column(type="string",unique=true,length=255)
     * @Assert\NotBlank()
     */    
    private $nameProject;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameProject
     *
     * @param string $nameProject
     *
     * @return Project
     */
    public function setNameProject($nameProject)
    {
        $this->nameProject = $nameProject;

        return $this;
    }

    /**
     * Get nameProject
     *
     * @return string
     */
    public function getNameProject()
    {
        return $this->nameProject;
    }
}
