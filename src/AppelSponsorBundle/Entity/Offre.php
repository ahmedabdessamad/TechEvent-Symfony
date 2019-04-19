<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table(name="offre", indexes={@ORM\Index(name="IDX_AF86866F71F7E88B", columns={"event_id"})})
 * @ORM\Entity
 */
class Offre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descoffre", type="string", length=255, nullable=false)
     */
    private $descoffre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedeboffre", type="date", nullable=false)
     */
    private $datedeboffre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefinoffre", type="date", nullable=false)
     */
    private $datefinoffre;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;


}

