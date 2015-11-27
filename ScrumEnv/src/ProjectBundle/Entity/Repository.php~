<?php
namespace ProjectBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Repository
{      
    /**
     * @ORM\Column(type="string",length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */    
    private $id;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $type;
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
    private $repoOwner;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     */    
    private $repoName;

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Repository
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
     * Set type
     *
     * @param string $type
     *
     * @return Repository
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set owner
     *
     * @param string $owner
     *
     * @return Repository
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
     * @return Repository
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
     * Set repoOwner
     *
     * @param string $repoOwner
     *
     * @return Repository
     */
    public function setRepoOwner($repoOwner)
    {
        $this->repoOwner = $repoOwner;

        return $this;
    }

    /**
     * Get repoOwner
     *
     * @return string
     */
    public function getRepoOwner()
    {
        return $this->repoOwner;
    }

    /**
     * Set repoName
     *
     * @param string $repoName
     *
     * @return Repository
     */
    public function setRepoName($repoName)
    {
        $this->repoName = $repoName;

        return $this;
    }

    /**
     * Get repoName
     *
     * @return string
     */
    public function getRepoName()
    {
        return $this->repoName;
    }
}
