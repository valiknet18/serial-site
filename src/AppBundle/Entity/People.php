<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Actor
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="peoples")
 */
class People
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
     * @var strin
     *
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"surname", "name"})
     */
    protected $slug;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Serial", inversedBy="directors")
     * @ORM\JoinTable(name="director_serial",
     *                  joinColumns={@ORM\JoinColumn(name="director_id", referencedColumnName="id")},
     *                  inverseJoinColumns={@ORM\JoinColumn(name="serial_id", referencedColumnName="id")}
     * )
     */
    protected $director_serials;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Serial", inversedBy="actors")
     * @ORM\JoinTable(name="actor_serial",
     *                  joinColumns={@ORM\JoinColumn(name="actor_id", referencedColumnName="id")},
     *                  inverseJoinColumns={@ORM\JoinColumn(name="serial_id", referencedColumnName="id")}
     * )
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
     * @param  string $surname
     * @return People
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
     * @param  string $name
     * @return People
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
     * @param  string $slug
     * @return People
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
     * Set birthday
     *
     * @param  \DateTime $birthday
     * @return People
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
     * @param  \AppBundle\Entity\Serial $directorSerials
     * @return People
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
     * @param  \AppBundle\Entity\Serial $actorSerials
     * @return People
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
