<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Serial
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="serials")
 * @ORM\HasLifecycleCallbacks
 */
class Serial
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $path;

    /**
     * @var string
     */
    protected $poster;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var text
     *
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    protected $releasedAt;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\People", mappedBy="actor_serials")
     * @ORM\JoinTable(name="actor_serial",
     *                  joinColumns={@ORM\JoinColumn(name="serial_id", referencedColumnName="id")},
     *                  inverseJoinColumns={@ORM\JoinColumn(name="actor_id", referencedColumnName="id")}
     * )
     */
    protected $actors;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\People", mappedBy="director_serials")
     * @ORM\JoinTable(name="director_serial",
     *                  joinColumns={@ORM\JoinColumn(name="serial_id", referencedColumnName="id")},
     *                  inverseJoinColumns={@ORM\JoinColumn(name="director_id", referencedColumnName="id")}
     * )
     */
    protected $directors;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Genre", mappedBy="serials")
     */
    protected $genres;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Season", mappedBy="serial")
     */
    protected $seasons;

    protected $temporary;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seasons = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set poster
     *
     * @param  string $poster
     * @return Serial
     */
    public function setPoster(UploadedFile $poster = null)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster
     *
     * @return string
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return Serial
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
     * Set name
     *
     * @param  string $name
     * @return Serial
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
     * Set description
     *
     * @param  string $description
     * @return Serial
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set releasedAt
     *
     * @param  \DateTime $releasedAt
     * @return Serial
     */
    public function setReleasedAt($releasedAt)
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    /**
     * Get releasedAt
     *
     * @return \DateTime
     */
    public function getReleasedAt()
    {
        return $this->releasedAt;
    }

    /**
     * Set country
     *
     * @param  string $country
     * @return Serial
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param  string $city
     * @return Serial
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add actors
     *
     * @param  \AppBundle\Entity\People $actors
     * @return Serial
     */
    public function addActor(\AppBundle\Entity\People $actors)
    {
        $this->actors[] = $actors;

        return $this;
    }

    /**
     * Remove actors
     *
     * @param \AppBundle\Entity\People $actors
     */
    public function removeActor(\AppBundle\Entity\People $actors)
    {
        $this->actors->removeElement($actors);
    }

    /**
     * Get actors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Add directors
     *
     * @param  \AppBundle\Entity\People $directors
     * @return Serial
     */
    public function addDirector(\AppBundle\Entity\People $directors)
    {
        $this->directors[] = $directors;

        return $this;
    }

    /**
     * Remove directors
     *
     * @param \AppBundle\Entity\People $directors
     */
    public function removeDirector(\AppBundle\Entity\People $directors)
    {
        $this->directors->removeElement($directors);
    }

    /**
     * Get directors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * Add genres
     *
     * @param  \AppBundle\Entity\Genre $genres
     * @return Serial
     */
    public function addGenre(\AppBundle\Entity\Genre $genres)
    {
        $this->genres[] = $genres;

        return $this;
    }

    /**
     * Remove genres
     *
     * @param \AppBundle\Entity\Genre $genres
     */
    public function removeGenre(\AppBundle\Entity\Genre $genres)
    {
        $this->genres->removeElement($genres);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Add seasons
     *
     * @param  \AppBundle\Entity\Season $seasons
     * @return Serial
     */
    public function addSeason(\AppBundle\Entity\Season $seasons)
    {
        $this->seasons[] = $seasons;

        return $this;
    }

    /**
     * Remove seasons
     *
     * @param \AppBundle\Entity\Season $seasons
     */
    public function removeSeason(\AppBundle\Entity\Season $seasons)
    {
        $this->seasons->removeElement($seasons);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * @return null|string
     */
    public function getAbsolutePath()
    {
        if (strstr($this->path, 'http://') || strpos($this->path, 'https://')) {
            return $this->path;
        }

        return null === $this->path
            ? null
            : '/'.$this->getUploadDir().'/'.$this->path;
    }

    /**
     * @return null|string
     */
    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    /**
     * @return string
     */
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    /**
     * @return string
     */
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/serials';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getPoster()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getPoster()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getPoster()) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getPoster()->move($this->getUploadRootDir(), $this->path);
        // check if we have an old image
        if (isset($this->temporary)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temporary);
            // clear the temp image path
            $this->temporary = null;
        }
        $this->poster = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Serial
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    public function __toString()
    {
        return $this->name;
    }
}
