<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Signaler
 *
 * @ORM\Table(name="signaler")
 * @ORM\Entity
 *
 */
class Signaler
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
     * @var int
     *
     * @ORM\Column(name="usr_id", type="integer")
     *
     *
     */
    private $sponsor;

    /**
     * @var string
     *
     * @ORM\Column(name="Club", type="string", length=255)
     */
    private $club;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * Set club
     *
     * @param string $club
     *
     * @return Signaler
     */
    public function setClub($club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return string
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Signaler
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
     * @return int
     */
    public function getSponsor()
    {
        return $this->sponsor;
    }

    /**
     * @param int $sponsor
     */
    public function setSponsor($sponsor)
    {
        $this->sponsor = $sponsor;
    }

}

