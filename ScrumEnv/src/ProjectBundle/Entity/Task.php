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
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_task;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $describe_task;


    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */    
    private $Time;


    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $achievement_task;


    

    /**
     * Get idTask
     *
     * @return integer
     */
    public function getIdTask()
    {
        return $this->id_task;
    }

    /**
     * Set describeTask
     *
     * @param string $describeTask
     *
     * @return Task
     */
    public function setDescribeTask($describeTask)
    {
        $this->describe_task = $describeTask;

        return $this;
    }

    /**
     * Get describeTask
     *
     * @return string
     */
    public function getDescribeTask()
    {
        return $this->describe_task;
    }

    /**
     * Set time
     *
     * @param integer $time
     *
     * @return Task
     */
    public function setTime($time)
    {
        $this->Time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->Time;
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
}
