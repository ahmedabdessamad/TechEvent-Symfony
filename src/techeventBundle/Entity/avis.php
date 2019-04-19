<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="techeventBundle\Repository\avisRepository")
 */
class avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="review", type="string", length=255)
     */
    private $review;

    /**
     * @var int
     *
     * @ORM\Column(name="stars", type="integer")
     */
    private $stars;

    /**
     * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="avis")
     * @ORM\JoinColumn(name="idres", referencedColumnName="id")
     */
    private $idres;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="avis")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */
    private $iduser;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set review
     *
     * @param string $review
     *
     * @return avis
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set stars
     *
     * @param integer $stars
     *
     * @return avis
     */
    public function setStars($stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * Get stars
     *
     * @return int
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @return mixed
     */
    public function getIdres()
    {
        return $this->idres;
    }

    /**
     * @param mixed $idres
     */
    public function setIdres($idres)
    {
        $this->idres = $idres;
    }

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param mixed $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

}

