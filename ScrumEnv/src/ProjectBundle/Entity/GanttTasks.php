<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GanttTasks
 *
 * @ORM\Table(name="gantt_tasks")
 * @ORM\Entity
 */
class GanttTasks
{
    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=false)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false)
     */
    private $startDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=false)
     */
    private $duration;

    /**
     * @var float
     *
     * @ORM\Column(name="progress", type="float", precision=10, scale=0, nullable=false)
     */
    private $progress;

    /**
     * @var integer
     *
     * @ORM\Column(name="sortorder", type="integer", nullable=false)
     */
    private $sortorder;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent", type="integer", nullable=false)
     */
    private $parent;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

         /**
     * @var integer
     *
     * @ORM\Column(name="sprint", type="integer")
     */
    private $sprint;


    /**
     * Set text
     *
     * @param string $text
     *
     * @return GanttTasks
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return GanttTasks
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return GanttTasks
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set progress
     *
     * @param float $progress
     *
     * @return GanttTasks
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return float
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set sortorder
     *
     * @param integer $sortorder
     *
     * @return GanttTasks
     */
    public function setSortorder($sortorder)
    {
        $this->sortorder = $sortorder;

        return $this;
    }

    /**
     * Get sortorder
     *
     * @return integer
     */
    public function getSortorder()
    {
        return $this->sortorder;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     *
     * @return GanttTasks
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

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
     * Set sprint
     *
     * @param integer $sprint
     *
     * @return GanttTasks
     */
    public function setSprint($sprint)
    {
        $this->sprint = $sprint;

        return $this;
    }

    /**
     * Get sprint
     *
     * @return integer
     */
    public function getSprint()
    {
        return $this->sprint;
    }
}