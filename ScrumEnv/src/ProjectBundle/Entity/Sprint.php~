<?php
namespace ProjectBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Sprint
{
    /**
     * @ORM\Column(type="string",length=255)
     * @ORM\Id
     */  
    protected $id;
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
     * @ORM\Column(type="date",length=255)
     * @Assert\NotBlank()
     */ 
    private $dateBegining;
    /**
     * @ORM\Column(type="date",length=255)
     * @Assert\NotBlank()
     */ 
    private $dateEnd;

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
     * @return Sprint
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
     * @return Sprint
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
     * @return Sprint
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
     * Set dateBegining
     *
     * @param \DateTime $dateBegining
     *
     * @return Sprint
     */
    public function setDateBegining($dateBegining)
    {
        $this->dateBegining = $dateBegining;

        return $this;
    }

    /**
     * Get dateBegining
     *
     * @return \DateTime
     */
    public function getDateBegining()
    {
        return $this->dateBegining;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Sprint
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Sprint
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
