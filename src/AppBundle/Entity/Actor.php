<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Actor
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="actors")
 */
class Actor
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $surname;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="date")
     */
    protected $birthday;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Serial", inversedBy="directors")
     */
    protected $director_serials;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Serial", inversedBy="actors")
     */
    protected $actor_serials;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->director_serials = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actor_serials = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set surname
     *
     * @param string $surname
     * @return Actor
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Actor
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
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Actor
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Add director_serials
     *
     * @param \AppBundle\Entity\Serial $directorSerials
     * @return Actor
     */
    public function addDirectorSerial(\AppBundle\Entity\Serial $directorSerials)
    {
        $this->director_serials[] = $directorSerials;

        return $this;
    }

    /**
     * Remove director_serials
     *
     * @param \AppBundle\Entity\Serial $directorSerials
     */
    public function removeDirectorSerial(\AppBundle\Entity\Serial $directorSerials)
    {
        $this->director_serials->removeElement($directorSerials);
    }

    /**
     * Get director_serials
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDirectorSerials()
    {
        return $this->director_serials;
    }

    /**
     * Add actor_serials
     *
     * @param \AppBundle\Entity\Serial $actorSerials
     * @return Actor
     */
    public function addActorSerial(\AppBundle\Entity\Serial $actorSerials)
    {
        $this->actor_serials[] = $actorSerials;

        return $this;
    }

    /**
     * Remove actor_serials
     *
     * @param \AppBundle\Entity\Serial $actorSerials
     */
    public function removeActorSerial(\AppBundle\Entity\Serial $actorSerials)
    {
        $this->actor_serials->removeElement($actorSerials);
    }

    /**
     * Get actor_serials
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActorSerials()
    {
        return $this->actor_serials;
    }
}
