<?php

namespace AppBundle\Entity\DTP;

/**
 * Attendee
 */
class Attendee
{
    /**
     * @var integer
     */
    private $playerId;

    /**
     * @var integer
     */
    private $tournamentId;

    /**
     * @var integer
     */
    private $nr;

    /**
     * @var integer
     */
    private $points;

    /**
     * @var string
     */
    private $extraPoints;

    /**
     * @var string
     */
    private $totalPoints;

    /**
     * @var integer
     */
    private $rank;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\DTP\Tournament
     */
    private $tournament;

    /**
     * @var \AppBundle\Entity\DTP\Player
     */
    private $player;


    /**
     * Set playerId
     *
     * @param integer $playerId
     *
     * @return Attendee
     */
    public function setPlayerId($playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return integer
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }

    /**
     * Set tournamentId
     *
     * @param integer $tournamentId
     *
     * @return Attendee
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
     * Set nr
     *
     * @param integer $nr
     *
     * @return Attendee
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
     * Set points
     *
     * @param integer $points
     *
     * @return Attendee
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set extraPoints
     *
     * @param string $extraPoints
     *
     * @return Attendee
     */
    public function setExtraPoints($extraPoints)
    {
        $this->extraPoints = $extraPoints;

        return $this;
    }

    /**
     * Get extraPoints
     *
     * @return string
     */
    public function getExtraPoints()
    {
        return $this->extraPoints;
    }

    /**
     * Set totalPoints
     *
     * @param string $totalPoints
     *
     * @return Attendee
     */
    public function setTotalPoints($totalPoints)
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    /**
     * Get totalPoints
     *
     * @return string
     */
    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return Attendee
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
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
     * @return Attendee
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

    /**
     * Set player
     *
     * @param \AppBundle\Entity\DTP\Player $player
     *
     * @return Attendee
     */
    public function setPlayer(\AppBundle\Entity\DTP\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \AppBundle\Entity\DTP\Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
}

