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
     * @Assert\NotBlank()
     */    
    private $description;  
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $cost;  
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $priority;  

    
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $achievement_task;

    /**
     * Set idTask
     *
     * @param string $idTask
     *
     * @return Task
     */
    public function setIdTask($idTask)
    {
        $this->id_task = $idTask;

        return $this;
    }

    /**
     * Get idTask
     *
     * @return string
     */
    public function getIdTask()
    {
        return $this->id_task;
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
     * Set descriptionTask
     *
     * @param string $descriptionTask
     *
     * @return Task
     */
    public function setDescriptionTask($descriptionTask)
    {
        $this->description_task = $descriptionTask;

        return $this;
    }

    /**
     * Get descriptionTask
     *
     * @return string
     */
    public function getDescriptionTask()
    {
        return $this->description_task;
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
     * Set priority
     *
     * @param string $priority
     *
     * @return Task
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
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
}
