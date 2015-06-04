<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Genre
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="genres")
 */
class Genre
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
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Gedmo\Slug(fields={"name"})
     */
    protected $slug;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Serial", inversedBy="genres")
     */
    protected $serials;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->serials = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param  string $name
     * @return Genre
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
     * @return Genre
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
     * Add serials
     *
     * @param  \AppBundle\Entity\Serial $serials
     * @return Genre
     */
    public function addSerial(\AppBundle\Entity\Serial $serials)
    {
        $this->serials[] = $serials;

        return $this;
    }

    /**
     * Remove serials
     *
     * @param \AppBundle\Entity\Serial $serials
     */
    public function removeSerial(\AppBundle\Entity\Serial $serials)
    {
        $this->serials->removeElement($serials);
    }

    /**
     * Get serials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSerials()
    {
        return $this->serials;
    }

    public function __toString()
    {
        return $this->name;
    }
}
