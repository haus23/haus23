<?php

namespace AppBundle\Entity;

/**
 * Tipp
 */
class Tipp
{
    /**
     * @var integer
     */
    private $turnierId;

    /**
     * @var integer
     */
    private $spielerId;

    /**
     * @var integer
     */
    private $spielId;

    /**
     * @var string
     */
    private $tipp;

    /**
     * @var integer
     */
    private $joker;

    /**
     * @var integer
     */
    private $zusatzjoker;

    /**
     * @var integer
     */
    private $punkte;

    /**
     * @var integer
     */
    private $sonder;

    /**
     * @var integer
     */
    private $closed;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set turnierId
     *
     * @param integer $turnierId
     *
     * @return Tipp
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
     * Set spielerId
     *
     * @param integer $spielerId
     *
     * @return Tipp
     */
    public function setSpielerId($spielerId)
    {
        $this->spielerId = $spielerId;

        return $this;
    }

    /**
     * Get spielerId
     *
     * @return integer
     */
    public function getSpielerId()
    {
        return $this->spielerId;
    }

    /**
     * Set spielId
     *
     * @param integer $spielId
     *
     * @return Tipp
     */
    public function setSpielId($spielId)
    {
        $this->spielId = $spielId;

        return $this;
    }

    /**
     * Get spielId
     *
     * @return integer
     */
    public function getSpielId()
    {
        return $this->spielId;
    }

    /**
     * Set tipp
     *
     * @param string $tipp
     *
     * @return Tipp
     */
    public function setTipp($tipp)
    {
        $this->tipp = $tipp;

        return $this;
    }

    /**
     * Get tipp
     *
     * @return string
     */
    public function getTipp()
    {
        return $this->tipp;
    }

    /**
     * Set joker
     *
     * @param integer $joker
     *
     * @return Tipp
     */
    public function setJoker($joker)
    {
        $this->joker = $joker;

        return $this;
    }

    /**
     * Get joker
     *
     * @return integer
     */
    public function getJoker()
    {
        return $this->joker;
    }

    /**
     * Set zusatzjoker
     *
     * @param integer $zusatzjoker
     *
     * @return Tipp
     */
    public function setZusatzjoker($zusatzjoker)
    {
        $this->zusatzjoker = $zusatzjoker;

        return $this;
    }

    /**
     * Get zusatzjoker
     *
     * @return integer
     */
    public function getZusatzjoker()
    {
        return $this->zusatzjoker;
    }

    /**
     * Set punkte
     *
     * @param integer $punkte
     *
     * @return Tipp
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
     * Set sonder
     *
     * @param integer $sonder
     *
     * @return Tipp
     */
    public function setSonder($sonder)
    {
        $this->sonder = $sonder;

        return $this;
    }

    /**
     * Get sonder
     *
     * @return integer
     */
    public function getSonder()
    {
        return $this->sonder;
    }

    /**
     * Set closed
     *
     * @param integer $closed
     *
     * @return Tipp
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return integer
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Tipp
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
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
}

