<?php
namespace ProjectBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Dependencies
{

	   /**
     * @ORM\Column(type="string",length=255)
     * @ORM\Id
     * @Assert\NotBlank()
     */    
    private $id;
}