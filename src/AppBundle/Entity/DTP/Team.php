<?php

namespace AppBundle\Entity\DTP;

/**
 * Team
 */
class Team
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $shortname;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Team
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
     * Set shortname
     *
     * @param string $shortname
     *
     * @return Team
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Team
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $home_matches;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $away_matches;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->home_matches = new \Doctrine\Common\Collections\ArrayCollection();
        $this->away_matches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add homeMatch
     *
     * @param \AppBundle\Entity\DTP\Match $homeMatch
     *
     * @return Team
     */
    public function addHomeMatch(\AppBundle\Entity\DTP\Match $homeMatch)
    {
        $this->home_matches[] = $homeMatch;

        return $this;
    }

    /**
     * Remove homeMatch
     *
     * @param \AppBundle\Entity\DTP\Match $homeMatch
     */
    public function removeHomeMatch(\AppBundle\Entity\DTP\Match $homeMatch)
    {
        $this->home_matches->removeElement($homeMatch);
    }

    /**
     * Get homeMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeMatches()
    {
        return $this->home_matches;
    }

    /**
     * Add awayMatch
     *
     * @param \AppBundle\Entity\DTP\Match $awayMatch
     *
     * @return Team
     */
    public function addAwayMatch(\AppBundle\Entity\DTP\Match $awayMatch)
    {
        $this->away_matches[] = $awayMatch;

        return $this;
    }

    /**
     * Remove awayMatch
     *
     * @param \AppBundle\Entity\DTP\Match $awayMatch
     */
    public function removeAwayMatch(\AppBundle\Entity\DTP\Match $awayMatch)
    {
        $this->away_matches->removeElement($awayMatch);
    }

    /**
     * Get awayMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwayMatches()
    {
        return $this->away_matches;
    }

    function __toString()
    {
        return $this->getName();
    }


}
