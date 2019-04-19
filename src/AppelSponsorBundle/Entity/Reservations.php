<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservations
 *
 * @ORM\Table(name="reservations", indexes={@ORM\Index(name="IDX_4DA239A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_4DA23971F7E88B", columns={"event_id"})})
 * @ORM\Entity
 */
class Reservations
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=true)
     */
    private $eventId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateRes", type="date", nullable=false)
     */
    private $dateres;

    /**
     * @var integer
     *
     * @ORM\Column(name="Qte", type="integer", nullable=false)
     */
    private $qte;

    /**
     * @var string
     *
     * @ORM\Column(name="TypeRese", type="string", length=255, nullable=false)
     */
    private $typerese;

    /**
     * @var string
     *
     * @ORM\Column(name="seat", type="string", length=255, nullable=false)
     */
    private $seat;


}

