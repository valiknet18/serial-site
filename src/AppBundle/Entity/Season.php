<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Season
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="seasons")
 */
class Season
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $number;

    /**
     * @var date
     *
     * @ORM\Column(type="date")
     */
    protected $date_start;

    /**
     * @var date
     *
     * @ORM\Column(type="date")
     */
    protected $date_end;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Season", inversedBy="seasons")
     */
    protected $serial;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Episode", mappedBy="season")
     */
    protected $episodes;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->episodes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set number
     *
     * @param  integer $number
     * @return Season
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set date_start
     *
     * @param  \DateTime $dateStart
     * @return Season
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;

        return $this;
    }

    /**
     * Get date_start
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * Set date_end
     *
     * @param  \DateTime $dateEnd
     * @return Season
     */
    public function setDateEnd($dateEnd)
    {
        $this->date_end = $dateEnd;

        return $this;
    }

    /**
     * Get date_end
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * Set serial
     *
     * @param  \AppBundle\Entity\Season $serial
     * @return Season
     */
    public function setSerial(\AppBundle\Entity\Season $serial = null)
    {
        $this->serial = $serial;

        return $this;
    }

    /**
     * Get serial
     *
     * @return \AppBundle\Entity\Season
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Add episodes
     *
     * @param  \AppBundle\Entity\Episode $episodes
     * @return Season
     */
    public function addEpisode(\AppBundle\Entity\Episode $episodes)
    {
        $this->episodes[] = $episodes;

        return $this;
    }

    /**
     * Remove episodes
     *
     * @param \AppBundle\Entity\Episode $episodes
     */
    public function removeEpisode(\AppBundle\Entity\Episode $episodes)
    {
        $this->episodes->removeElement($episodes);
    }

    /**
     * Get episodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }
}
