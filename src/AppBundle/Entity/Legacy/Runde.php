<?php

namespace AppBundle\Entity\Legacy;

/**
 * Runde
 */
class Runde
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
    private $anzahlSpiele;

    /**
     * @var integer
     */
    private $completed;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set turnierId
     *
     * @param integer $turnierId
     *
     * @return Runde
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
     * @return Runde
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
     * Set anzahlSpiele
     *
     * @param integer $anzahlSpiele
     *
     * @return Runde
     */
    public function setAnzahlSpiele($anzahlSpiele)
    {
        $this->anzahlSpiele = $anzahlSpiele;

        return $this;
    }

    /**
     * Get anzahlSpiele
     *
     * @return integer
     */
    public function getAnzahlSpiele()
    {
        return $this->anzahlSpiele;
    }

    /**
     * Set completed
     *
     * @param integer $completed
     *
     * @return Runde
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return integer
     */
    public function getCompleted()
    {
        return $this->completed;
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
     * @var \AppBundle\Entity\Legacy\Turnier
     */
    private $championship;


    /**
     * Set championship
     *
     * @param \AppBundle\Entity\Legacy\Turnier $championship
     *
     * @return Runde
     */
    public function setChampionship(\AppBundle\Entity\Legacy\Turnier $championship = null)
    {
        $this->championship = $championship;

        return $this;
    }

    /**
     * Get championship
     *
     * @return \AppBundle\Entity\Legacy\Turnier
     */
    public function getChampionship()
    {
        return $this->championship;
    }
}
