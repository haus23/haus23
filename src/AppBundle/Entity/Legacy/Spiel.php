<?php

namespace AppBundle\Entity\Legacy;

/**
 * Spiel
 */
class Spiel
{
    /**
     * @var integer
     */
    private $turnierId;

    /**
     * @var integer
     */
    private $rundeId;

    /**
     * @var integer
     */
    private $nr;

    /**
     * @var string
     */
    private $liga;

    /**
     * @var \DateTime
     */
    private $datum;

    /**
     * @var string
     */
    private $paarung;

    /**
     * @var boolean
     */
    private $topspiel = '0';

    /**
     * @var string
     */
    private $ergebnis;

    /**
     * @var integer
     */
    private $punkte;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set turnierId
     *
     * @param integer $turnierId
     *
     * @return Spiel
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
     * Set rundeId
     *
     * @param integer $rundeId
     *
     * @return Spiel
     */
    public function setRundeId($rundeId)
    {
        $this->rundeId = $rundeId;

        return $this;
    }

    /**
     * Get rundeId
     *
     * @return integer
     */
    public function getRundeId()
    {
        return $this->rundeId;
    }

    /**
     * Set nr
     *
     * @param integer $nr
     *
     * @return Spiel
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
     * Set liga
     *
     * @param string $liga
     *
     * @return Spiel
     */
    public function setLiga($liga)
    {
        $this->liga = $liga;

        return $this;
    }

    /**
     * Get liga
     *
     * @return string
     */
    public function getLiga()
    {
        return $this->liga;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Spiel
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set paarung
     *
     * @param string $paarung
     *
     * @return Spiel
     */
    public function setPaarung($paarung)
    {
        $this->paarung = $paarung;

        return $this;
    }

    /**
     * Get paarung
     *
     * @return string
     */
    public function getPaarung()
    {
        return $this->paarung;
    }

    /**
     * Set topspiel
     *
     * @param boolean $topspiel
     *
     * @return Spiel
     */
    public function setTopspiel($topspiel)
    {
        $this->topspiel = $topspiel;

        return $this;
    }

    /**
     * Get topspiel
     *
     * @return boolean
     */
    public function getTopspiel()
    {
        return $this->topspiel;
    }

    /**
     * Set ergebnis
     *
     * @param string $ergebnis
     *
     * @return Spiel
     */
    public function setErgebnis($ergebnis)
    {
        $this->ergebnis = $ergebnis;

        return $this;
    }

    /**
     * Get ergebnis
     *
     * @return string
     */
    public function getErgebnis()
    {
        return $this->ergebnis;
    }

    /**
     * Set punkte
     *
     * @param integer $punkte
     *
     * @return Spiel
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var \AppBundle\Entity\Legacy\Runde
     */
    private $round;


    /**
     * Set round
     *
     * @param \AppBundle\Entity\Legacy\Runde $round
     *
     * @return Spiel
     */
    public function setRound(\AppBundle\Entity\Legacy\Runde $round = null)
    {
        $this->round = $round;

        return $this;
    }

    /**
     * Get round
     *
     * @return \AppBundle\Entity\Legacy\Runde
     */
    public function getRound()
    {
        return $this->round;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tips;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tips = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tip
     *
     * @param \AppBundle\Entity\Legacy\Tipp $tip
     *
     * @return Spiel
     */
    public function addTip(\AppBundle\Entity\Legacy\Tipp $tip)
    {
        $this->tips[] = $tip;

        return $this;
    }

    /**
     * Remove tip
     *
     * @param \AppBundle\Entity\Legacy\Tipp $tip
     */
    public function removeTip(\AppBundle\Entity\Legacy\Tipp $tip)
    {
        $this->tips->removeElement($tip);
    }

    /**
     * Get tips
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTips()
    {
        return $this->tips;
    }

    /**
     * Get fixture slug
     *
     * @return string
     */
    public function getSlug()
    {
        $germanTr = [
            'Ä' => 'AE',
            'Ö' => 'OE',
            'Ü' => 'UE',
            'ß' => 'ss',
            'ä' => 'ae',
            'ö' => 'oe',
            'ü' => 'ue',
        ];

        $regexp = '/([^A-Za-z0-9]|-)+/';

        $slug = mb_strtolower($this->paarung);
        $slug = strtr($slug, $germanTr);
        $slug = preg_replace($regexp, '-', $slug);
        return trim($slug, '-');
    }
}
