<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="IDX_4DA239A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_4DA23971F7E88B", columns={"event_id"})})
 * @ORM\Entity(repositoryClass="techeventBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateReservation", type="datetime", nullable=false)
     */
    private $datereservation = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="seat", type="string", length=255, nullable=false)
     */
    private $seat;

    /**
     * @var integer
     *
     * @ORM\Column(name="payer", type="integer", nullable=true)
     */
    private $payer;

    /**
     * @var string
     *
     * @ORM\Column(name="nomReservation", type="string", length=255, nullable=true)
     */
    private $nomreservation;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Panier", inversedBy="Reservation")
     * @ORM\JoinColumn(name="idpanier", referencedColumnName="id")
     */
    private $idpanier;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDatereservation()
    {
        return $this->datereservation;
    }

    /**
     * @param \DateTime $datereservation
     */
    public function setDatereservation($datereservation)
    {
        $this->datereservation = $datereservation;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;
    }

    /**
     * @return int
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param int $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return string
     */
    public function getNomreservation()
    {
        return $this->nomreservation;
    }

    /**
     * @param string $nomreservation
     */
    public function setNomreservation($nomreservation)
    {
        $this->nomreservation = $nomreservation;
    }

    /**
     * @return \Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param \Event $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getIdpanier()
    {
        return $this->idpanier;
    }

    /**
     * @param mixed $idpanier
     */
    public function setIdpanier($idpanier)
    {
        $this->idpanier = $idpanier;
    }



    public function __construct()
    {
        $this->setDatereservation(new \DateTime());
    }



}

