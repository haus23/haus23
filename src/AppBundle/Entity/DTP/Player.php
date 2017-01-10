<?php

namespace AppBundle\Entity\DTP;

/**
 * Player
 */
class Player
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
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Player
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
     * @return Player
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
     * Set email
     *
     * @param string $email
     *
     * @return Player
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
    private $attendances;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attendances = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add attendance
     *
     * @param \AppBundle\Entity\DTP\Attendee $attendance
     *
     * @return Player
     */
    public function addAttendance(\AppBundle\Entity\DTP\Attendee $attendance)
    {
        $this->attendances[] = $attendance;

        return $this;
    }

    /**
     * Remove attendance
     *
     * @param \AppBundle\Entity\DTP\Attendee $attendance
     */
    public function removeAttendance(\AppBundle\Entity\DTP\Attendee $attendance)
    {
        $this->attendances->removeElement($attendance);
    }

    /**
     * Get attendances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttendances()
    {
        return $this->attendances;
    }
}
