<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * dossierSponsoring
 *
 * @ORM\Table(name="dossierSponsoring")
 * @ORM\Entity
 */
class dossierSponsoring
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
     * @ORM\Column(name="nomevent", type="string", length=255, nullable=false)
     */
    private $nomevent;
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
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="descreptionevent", type="string", length=255, nullable=false)
     */
    private $descreptionevent;

    /**
     * @var string
     *
     * @ORM\Column(name="packSilver", type="string", length=255, nullable=false)
     */
    private $packSilver;

    /**
     * @var int
     *
     * @ORM\Column(name="prixSilver", type="integer", length=255, nullable=false)
     */
    private $prixSilver;

    /**
     * @var string
     *
     * @ORM\Column(name="packGold", type="string", length=255, nullable=false)
     */
    private $packGold;

    /**
     * @var string
     *
     * @ORM\Column(name="packDiamond", type="string", length=255, nullable=false)
     */
    private $packDiamond;

    /**
     * @var int
     *
     * @ORM\Column(name="prixGold", type="integer", length=255, nullable=false)
     */
    private $prixGold;

    /**
     * @var int
     *
     *@ORM\Column(name="prixDiamond", type="integer", length=255, nullable=false)
     */
    private $prixDiamond;


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
     * Set nomevent
     *
     * @param string $nomevent
     *
     * @return dossierSponsoring
     */
    public function setNomevent($nomevent)
    {
        $this->nomevent = $nomevent;

        return $this;
    }

    /**
     * Get nomevent
     *
     * @return string
     */
    public function getNomevent()
    {
        return $this->nomevent;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return dossierSponsoring
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set descreptionevent
     *
     * @param string $descreptionevent
     *
     * @return dossierSponsoring
     */
    public function setDescreptionevent($descreptionevent)
    {
        $this->descreptionevent = $descreptionevent;

        return $this;
    }

    /**
     * Get descreptionevent
     *
     * @return string
     */
    public function getDescreptionevent()
    {
        return $this->descreptionevent;
    }

    /**
     * Set packSilver
     *
     * @param string $packSilver
     *
     * @return dossierSponsoring
     */
    public function setPackSilver($packSilver)
    {
        $this->packSilver = $packSilver;

        return $this;
    }

    /**
     * Get packSilver
     *
     * @return string
     */
    public function getPackSilver()
    {
        return $this->packSilver;
    }

    /**
     * Set prixSilver
     *
     * @param integer $prixSilver
     *
     * @return dossierSponsoring
     */
    public function setPrixSilver($prixSilver)
    {
        $this->prixSilver = $prixSilver;

        return $this;
    }

    /**
     * Get prixSilver
     *
     * @return int
     */
    public function getPrixSilver()
    {
        return $this->prixSilver;
    }

    /**
     * Set packGold
     *
     * @param string $packGold
     *
     * @return dossierSponsoring
     */
    public function setPackGold($packGold)
    {
        $this->packGold = $packGold;

        return $this;
    }

    /**
     * Get packGold
     *
     * @return string
     */
    public function getPackGold()
    {
        return $this->packGold;
    }

    /**
     * Set packDiamond
     *
     * @param string $packDiamond
     *
     * @return dossierSponsoring
     */
    public function setPackDiamond($packDiamond)
    {
        $this->packDiamond = $packDiamond;

        return $this;
    }

    /**
     * Get packDiamond
     *
     * @return string
     */
    public function getPackDiamond()
    {
        return $this->packDiamond;
    }

    /**
     * Set prixGold
     *
     * @param integer $prixGold
     *
     * @return dossierSponsoring
     */
    public function setPrixGold($prixGold)
    {
        $this->prixGold = $prixGold;

        return $this;
    }

    /**
     * Get prixGold
     *
     * @return int
     */
    public function getPrixGold()
    {
        return $this->prixGold;
    }

    /**
     * Set prixDiamond
     *
     * @param integer $prixDiamond
     *
     * @return dossierSponsoring
     */
    public function setPrixDiamond($prixDiamond)
    {
        $this->prixDiamond = $prixDiamond;

        return $this;
    }

    /**
     * Get prixDiamond
     *
     * @return int
     */
    public function getPrixDiamond()
    {
        return $this->prixDiamond;
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


}

