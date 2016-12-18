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
}
