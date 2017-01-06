<?php

namespace AppBundle\Entity\DTP;

/**
 * Match
 */
class Match implements \JsonSerializable
{
    /**
     * @var integer
     */
    private $nr;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $result;

    /**
     * @var integer
     */
    private $tournamentId;

    /**
     * @var integer
     */
    private $roundId;

    /**
     * @var integer
     */
    private $leagueId;

    /**
     * @var integer
     */
    private $hometeamId;

    /**
     * @var integer
     */
    private $awayteamId;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\DTP\Tournament
     */
    private $tournament;

    /**
     * @var \AppBundle\Entity\DTP\Round
     */
    private $round;

    /**
     * @var \AppBundle\Entity\DTP\League
     */
    private $league;

    /**
     * @var \AppBundle\Entity\DTP\Team
     */
    private $hometeam;

    /**
     * @var \AppBundle\Entity\DTP\Team
     */
    private $awayteam;


    /**
     * Set nr
     *
     * @param integer $nr
     *
     * @return Match
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Match
     */
    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set result
     *
     * @param string $result
     *
     * @return Match
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set tournamentId
     *
     * @param integer $tournamentId
     *
     * @return Match
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
     * Set roundId
     *
     * @param integer $roundId
     *
     * @return Match
     */
    public function setRoundId($roundId)
    {
        $this->roundId = $roundId;

        return $this;
    }

    /**
     * Get roundId
     *
     * @return integer
     */
    public function getRoundId()
    {
        return $this->roundId;
    }

    /**
     * Set leagueId
     *
     * @param integer $leagueId
     *
     * @return Match
     */
    public function setLeagueId($leagueId)
    {
        $this->leagueId = $leagueId;

        return $this;
    }

    /**
     * Get leagueId
     *
     * @return integer
     */
    public function getLeagueId()
    {
        return $this->leagueId;
    }

    /**
     * Set hometeamId
     *
     * @param integer $hometeamId
     *
     * @return Match
     */
    public function setHometeamId($hometeamId)
    {
        $this->hometeamId = $hometeamId;

        return $this;
    }

    /**
     * Get hometeamId
     *
     * @return integer
     */
    public function getHometeamId()
    {
        return $this->hometeamId;
    }

    /**
     * Set awayteamId
     *
     * @param integer $awayteamId
     *
     * @return Match
     */
    public function setAwayteamId($awayteamId)
    {
        $this->awayteamId = $awayteamId;

        return $this;
    }

    /**
     * Get awayteamId
     *
     * @return integer
     */
    public function getAwayteamId()
    {
        return $this->awayteamId;
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
     * @return Match
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
     * Set round
     *
     * @param \AppBundle\Entity\DTP\Round $round
     *
     * @return Match
     */
    public function setRound(\AppBundle\Entity\DTP\Round $round = null)
    {
        $this->round = $round;

        return $this;
    }

    /**
     * Get round
     *
     * @return \AppBundle\Entity\DTP\Round
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Set league
     *
     * @param \AppBundle\Entity\DTP\League $league
     *
     * @return Match
     */
    public function setLeague(\AppBundle\Entity\DTP\League $league = null)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * Get league
     *
     * @return \AppBundle\Entity\DTP\League
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * Set hometeam
     *
     * @param \AppBundle\Entity\DTP\Team $hometeam
     *
     * @return Match
     */
    public function setHometeam(\AppBundle\Entity\DTP\Team $hometeam = null)
    {
        $this->hometeam = $hometeam;

        return $this;
    }

    /**
     * Get hometeam
     *
     * @return \AppBundle\Entity\DTP\Team
     */
    public function getHometeam()
    {
        return $this->hometeam;
    }

    /**
     * Set awayteam
     *
     * @param \AppBundle\Entity\DTP\Team $awayteam
     *
     * @return Match
     */
    public function setAwayteam(\AppBundle\Entity\DTP\Team $awayteam = null)
    {
        $this->awayteam = $awayteam;

        return $this;
    }

    /**
     * Get awayteam
     *
     * @return \AppBundle\Entity\DTP\Team
     */
    public function getAwayteam()
    {
        return $this->awayteam;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nr' => $this->nr
        ];
    }
}

