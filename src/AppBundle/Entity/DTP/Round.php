<?php

namespace AppBundle\Entity\DTP;

/**
 * Round
 */
class Round
{
    /**
     * @var integer
     */
    private $nr;

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
    private $tournamentId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\DTP\Tournament
     */
    private $tournament;


    /**
     * Set nr
     *
     * @param integer $nr
     *
     * @return Round
     */
    public function setNr($nr)
    {
        $this->nr = $nr;

        return $this;
    }

    /**
     * Get nr
     *
     * @return integer
     */
    public function getNr()
    {
        return $this->nr;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Round
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
     * @return Round
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
     * Set tournamentId
     *
     * @param integer $tournamentId
     *
     * @return Round
     */
    public function setTournamentId($tournamentId)
    {
        $this->tournamentId = $tournamentId;

        return $this;
    }

    /**
     * Get tournamentId
     *
     * @return integer
     */
    public function getTournamentId()
    {
        return $this->tournamentId;
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
     * Set tournament
     *
     * @param \AppBundle\Entity\DTP\Tournament $tournament
     *
     * @return Round
     */
    public function setTournament(\AppBundle\Entity\DTP\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \AppBundle\Entity\DTP\Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }
}
