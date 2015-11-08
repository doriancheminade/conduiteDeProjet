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

    
}
