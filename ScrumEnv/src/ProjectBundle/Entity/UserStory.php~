<?php
namespace ProjectBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class UserStory
{

      /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */    
    private $id;
    
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $owner;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $project;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $description;


    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */    
    private $priority;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */    
    private $cost;

    

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
     * Set owner
     *
     * @param string $owner
     *
     * @return UserStory
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set project
     *
     * @param string $project
     *
     * @return UserStory
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return UserStory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return UserStory
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return UserStory
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }
}
