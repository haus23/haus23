<?php

namespace AppBundle\Entity;

/**
 * Spieler
 */
class Spieler
{
    /**
     * @var integer
     */
    private $turnierId;

    /**
     * @var integer
     */
    private $nr;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $punkte;

    /**
     * @var float
     */
    private $zusatz;

    /**
     * @var float
     */
    private $gesamt;

    /**
     * @var integer
     */
    private $platz;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set turnierId
     *
     * @param integer $turnierId
     *
     * @return Spieler
     */
    public function setTurnierId($turnierId)
    {
        $this->turnierId = $turnierId;

        return $this;
    }

    /**
     * Get turnierId
     *
     * @return integer
     */
    public function getTurnierId()
    {
        return $this->turnierId;
    }

    /**
     * Set nr
     *
     * @param integer $nr
     *
     * @return Spieler
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Spieler
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set punkte
     *
     * @param integer $punkte
     *
     * @return Spieler
     */
    public function setPunkte($punkte)
    {
        $this->punkte = $punkte;

        return $this;
    }

    /**
     * Get punkte
     *
     * @return integer
     */
    public function getPunkte()
    {
        return $this->punkte;
    }

    /**
     * Set zusatz
     *
     * @param float $zusatz
     *
     * @return Spieler
     */
    public function setZusatz($zusatz)
    {
        $this->zusatz = $zusatz;

        return $this;
    }

    /**
     * Get zusatz
     *
     * @return float
     */
    public function getZusatz()
    {
        return $this->zusatz;
    }

    /**
     * Set gesamt
     *
     * @param float $gesamt
     *
     * @return Spieler
     */
    public function setGesamt($gesamt)
    {
        $this->gesamt = $gesamt;

        return $this;
    }

    /**
     * Get gesamt
     *
     * @return float
     */
    public function getGesamt()
    {
        return $this->gesamt;
    }

    /**
     * Set platz
     *
     * @param integer $platz
     *
     * @return Spieler
     */
    public function setPlatz($platz)
    {
        $this->platz = $platz;

        return $this;
    }

    /**
     * Get platz
     *
     * @return integer
     */
    public function getPlatz()
    {
        return $this->platz;
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
     * @var \AppBundle\Entity\Turnier
     */
    private $championship;


    /**
     * Set championship
     *
     * @param \AppBundle\Entity\Turnier $championship
     *
     * @return Spieler
     */
    public function setChampionship(\AppBundle\Entity\Turnier $championship = null)
    {
        $this->championship = $championship;

        return $this;
    }

    /**
     * Get championship
     *
     * @return \AppBundle\Entity\Turnier
     */
    public function getChampionship()
    {
        return $this->championship;
    }
    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Spieler
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
