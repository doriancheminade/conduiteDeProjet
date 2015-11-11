<?php
namespace ProjectBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Task
{
    /**
     * @ORM\Column(type="string",length=255)
     * @ORM\Id
     * @Assert\NotBlank()
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
     */    
    private $sprint;  
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $description;  
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $cost;  

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string",length=255)
     */    
    private $achievement_task;

     /**
     * @ORM\Column(type="string",length=255)
     */    
    private $dependencies;

   

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Task
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
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
     * @return Task
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
     * @return Task
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
     * Set sprint
     *
     * @param string $sprint
     *
     * @return Task
     */
    public function setSprint($sprint)
    {
        $this->sprint = $sprint;

        return $this;
    }

    /**
     * Get sprint
     *
     * @return string
     */
    public function getSprint()
    {
        return $this->sprint;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Task
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
     * Set cost
     *
     * @param string $cost
     *
     * @return Task
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set achievementTask
     *
     * @param string $achievementTask
     *
     * @return Task
     */
    public function setAchievementTask($achievementTask)
    {
        $this->achievement_task = $achievementTask;

        return $this;
    }

    /**
     * Get achievementTask
     *
     * @return string
     */
    public function getAchievementTask()
    {
        return $this->achievement_task;
    }

    /**
     * Set dependencies
     *
     * @param string $dependencies
     *
     * @return Task
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    /**
     * Get dependencies
     *
     * @return string
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }
}
