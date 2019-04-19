<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppelSponsor
 *
 * @ORM\Table(name="appel_sponsor", indexes={@ORM\Index(name="IDX_1B06DC1A71F7E88B", columns={"event_id"}), @ORM\Index(name="IDX_1B06DC1AA76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class AppelSponsor
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
     * @ORM\Column(name="role", type="string", length=255, nullable=false)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation", type="string", length=255, nullable=true)
     */
    private $confirmation;

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getNomevent()
    {
        return $this->nomevent;
    }

    /**
     * @param string $nomevent
     */
    public function setNomevent($nomevent)
    {
        $this->nomevent = $nomevent;
    }

    /**
     * @return string
     */
    public function getDateevent()
    {
        return $this->dateevent;
    }

    /**
     * @param string $dateevent
     */
    public function setDateevent($dateevent)
    {
        $this->dateevent = $dateevent;
    }

    /**
     * @return string
     */
    public function getNomsponsor()
    {
        return $this->nomsponsor;
    }

    /**
     * @param string $nomsponsor
     */
    public function setNomsponsor($nomsponsor)
    {
        $this->nomsponsor = $nomsponsor;
    }



    /**
     *  @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;
    /**
     * @var string
     *
     * @ORM\Column(name="nomevent", type="string", length=255, nullable=true)
     */
    private $nomevent;
    /**
     * @var string
     *
     * @ORM\Column(name="dateevent", type="string", length=255, nullable=true)
     */
    private $dateevent;
    /**
     * @var string
     *
     * @ORM\Column(name="nomsponsor", type="string", length=255, nullable=true)
     */
    private $nomsponsor;
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
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * @param string $confirmation
     */
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;
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


}

