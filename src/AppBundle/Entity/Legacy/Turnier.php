<?php

namespace AppBundle\Entity\Legacy;

/**
 * Turnier
 */
class Turnier
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $order;

    /**
     * @var integer
     */
    private $completed;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Turnier
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return Turnier
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set completed
     *
     * @param integer $completed
     *
     * @return Turnier
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $players;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add player
     *
     * @param \AppBundle\Entity\Legacy\Spieler $player
     *
     * @return Turnier
     */
    public function addPlayer(\AppBundle\Entity\Legacy\Spieler $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param \AppBundle\Entity\Legacy\Spieler $player
     */
    public function removePlayer(\AppBundle\Entity\Legacy\Spieler $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Get title slug
     *
     * @return string
     */
    public function getSlug()
    {
        $nameParts = ['/^H.+ /' => 'hr', '/^R.+ /' => 'rr', '/^E. /' => 'em', '/^W. /' => 'wm'];
        $patterns = array_keys($nameParts);
        $replacements = array_values($nameParts);
        $slug = preg_replace($patterns, $replacements, $this->title);

        return preg_replace('/^(\w\w).*(\d\d)\/(\d\d)?$/', '$1$2$3', $slug);
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rounds;


    /**
     * Add round
     *
     * @param \AppBundle\Entity\Legacy\Runde $round
     *
     * @return Turnier
     */
    public function addRound(\AppBundle\Entity\Legacy\Runde $round)
    {
        $this->rounds[] = $round;

        return $this;
    }

    /**
     * Remove round
     *
     * @param \AppBundle\Entity\Legacy\Runde $round
     */
    public function removeRound(\AppBundle\Entity\Legacy\Runde $round)
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
}
