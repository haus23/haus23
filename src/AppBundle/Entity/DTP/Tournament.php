<?php

namespace AppBundle\Entity\DTP;

/**
 * Tournament
 */
class Tournament
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var boolean
     */
    private $published;

    /**
     * @var boolean
     */
    private $completed;

    /**
     * @var integer
     */
    private $rulesetId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\DTP\Ruleset
     */
    private $ruleset;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tournament
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Tournament
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Tournament
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
     * Set published
     *
     * @param boolean $published
     *
     * @return Tournament
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     *
     * @return Tournament
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return boolean
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set rulesetId
     *
     * @param integer $rulesetId
     *
     * @return Tournament
     */
    public function setRulesetId($rulesetId)
    {
        $this->rulesetId = $rulesetId;

        return $this;
    }

    /**
     * Get rulesetId
     *
     * @return integer
     */
    public function getRulesetId()
    {
        return $this->rulesetId;
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
     * Set ruleset
     *
     * @param \AppBundle\Entity\DTP\Ruleset $ruleset
     *
     * @return Tournament
     */
    public function setRuleset(\AppBundle\Entity\DTP\Ruleset $ruleset = null)
    {
        $this->ruleset = $ruleset;

        return $this;
    }

    /**
     * Get ruleset
     *
     * @return \AppBundle\Entity\DTP\Ruleset
     */
    public function getRuleset()
    {
        return $this->ruleset;
    }

    /**
     * Set id
     *
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rounds;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rounds = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add round
     *
     * @param \AppBundle\Entity\DTP\Round $round
     *
     * @return Tournament
     */
    public function addRound(\AppBundle\Entity\DTP\Round $round)
    {
        $this->rounds[] = $round;

        return $this;
    }

    /**
     * Remove round
     *
     * @param \AppBundle\Entity\DTP\Round $round
     */
    public function removeRound(\AppBundle\Entity\DTP\Round $round)
    {
        $this->rounds->removeElement($round);
    }

    /**
     * Get rounds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRounds()
    {
        return $this->rounds;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $matches;


    /**
     * Add match
     *
     * @param \AppBundle\Entity\DTP\Match $match
     *
     * @return Tournament
     */
    public function addMatch(\AppBundle\Entity\DTP\Match $match)
    {
        $this->matches[] = $match;

        return $this;
    }

    /**
     * Remove match
     *
     * @param \AppBundle\Entity\DTP\Match $match
     */
    public function removeMatch(\AppBundle\Entity\DTP\Match $match)
    {
        $this->matches->removeElement($match);
    }

    /**
     * Get matches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatches()
    {
        return $this->matches;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $attendees;


    /**
     * Add attendee
     *
     * @param \AppBundle\Entity\DTP\Attendee $attendee
     *
     * @return Tournament
     */
    public function addAttendee(\AppBundle\Entity\DTP\Attendee $attendee)
    {
        $this->attendees[] = $attendee;

        return $this;
    }

    /**
     * Remove attendee
     *
     * @param \AppBundle\Entity\DTP\Attendee $attendee
     */
    public function removeAttendee(\AppBundle\Entity\DTP\Attendee $attendee)
    {
        $this->attendees->removeElement($attendee);
    }

    /**
     * Get attendees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttendees()
    {
        return $this->attendees;
    }
}
