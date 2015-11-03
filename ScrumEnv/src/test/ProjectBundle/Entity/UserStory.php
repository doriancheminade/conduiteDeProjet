<?php
namespace test\ProjectBundle\Entity;
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
    private $id_UserStory;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $describe_UserStory;


    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */    
    private $priority_UserStory;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */    
    private $difficulty_UserStory;



    /**
     * Get idUserStory
     *
     * @return integer
     */
    public function getIdUserStory()
    {
        return $this->id_UserStory;
    }

    /**
     * Set describeUserStory
     *
     * @param string $describeUserStory
     *
     * @return Backlog
     */
    public function setDescribeUserStory($describeUserStory)
    {
        $this->describe_UserStory = $describeUserStory;

        return $this;
    }

    /**
     * Get describeUserStory
     *
     * @return string
     */
    public function getDescribeUserStory()
    {
        return $this->describe_UserStory;
    }

    /**
     * Set priorityUserStory
     *
     * @param integer $priorityUserStory
     *
     * @return Backlog
     */
    public function setPriorityUserStory($priorityUserStory)
    {
        $this->priority_UserStory = $priorityUserStory;

        return $this;
    }

    /**
     * Get priorityUserStory
     *
     * @return integer
     */
    public function getPriorityUserStory()
    {
        return $this->priority_UserStory;
    }

    /**
     * Set difficultyUserStory
     *
     * @param integer $difficultyUserStory
     *
     * @return Backlog
     */
    public function setDifficultyUserStory($difficultyUserStory)
    {
        $this->difficulty_UserStory = $difficultyUserStory;

        return $this;
    }

    /**
     * Get difficultyUserStory
     *
     * @return integer
     */
    public function getDifficultyUserStory()
    {
        return $this->difficulty_UserStory;
    }
}
