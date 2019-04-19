<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="IDX_3BAE0AA7A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="affiche", type="string", length=255, nullable=true)
     */
    private $affiche;

    /**
     * @var string
     *
     * @ORM\Column(name="nbrplaces", type="string", length=255, nullable=true)
     */
    private $nbrplaces;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255, nullable=true)
     */
    private $localisation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateevent", type="string", nullable=true)
     */
    private $dateevent;

    /**
     * @var string
     *
     * @ORM\Column(name="hdebut", type="string", length=255, nullable=true)
     */
    private $hdebut;

    /**
     * @var string
     *
     * @ORM\Column(name="hfin", type="string", length=255, nullable=true)
     */
    private $hfin;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="validation", type="string", length=255, nullable=true)
     */
    private $validation;

    /**
     * @return string
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * @param string $validation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="psilver", type="string", length=255, nullable=true)
     */
    private $psilver;

    /**
     * @var string
     *
     * @ORM\Column(name="pglod", type="string", length=255, nullable=true)
     */
    private $pglod;

    /**
     * @var string
     *
     * @ORM\Column(name="pdiamond", type="string", length=255, nullable=true)
     */
    private $pdiamond;

    /**
     * @var float
     *
     * @ORM\Column(name="prixsilver", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixsilver;

    /**
     * @var float
     *
     * @ORM\Column(name="prixgold", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixgold;

    /**
     * @var float
     *
     * @ORM\Column(name="prixdiamond", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixdiamond;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * @param string $affiche
     */
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;
    }

    /**
     * @return string
     */
    public function getNbrplaces()
    {
        return $this->nbrplaces;
    }

    /**
     * @param string $nbrplaces
     */
    public function setNbrplaces($nbrplaces)
    {
        $this->nbrplaces = $nbrplaces;
    }

    /**
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * @param string $localisation
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;
    }

    /**
     * @return \DateTime
     */
    public function getDateevent()
    {
        return $this->dateevent;
    }

    /**
     * @param \DateTime $dateevent
     */
    public function setDateevent($dateevent)
    {
        $this->dateevent = $dateevent;
    }

    /**
     * @return string
     */
    public function getHdebut()
    {
        return $this->hdebut;
    }

    /**
     * @param string $hdebut
     */
    public function setHdebut($hdebut)
    {
        $this->hdebut = $hdebut;
    }

    /**
     * @return string
     */
    public function getHfin()
    {
        return $this->hfin;
    }

    /**
     * @param string $hfin
     */
    public function setHfin($hfin)
    {
        $this->hfin = $hfin;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
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
    public function getPsilver()
    {
        return $this->psilver;
    }

    /**
     * @param string $psilver
     */
    public function setPsilver($psilver)
    {
        $this->psilver = $psilver;
    }

    /**
     * @return string
     */
    public function getPglod()
    {
        return $this->pglod;
    }

    /**
     * @param string $pglod
     */
    public function setPglod($pglod)
    {
        $this->pglod = $pglod;
    }

    /**
     * @return string
     */
    public function getPdiamond()
    {
        return $this->pdiamond;
    }

    /**
     * @param string $pdiamond
     */
    public function setPdiamond($pdiamond)
    {
        $this->pdiamond = $pdiamond;
    }

    /**
     * @return float
     */
    public function getPrixsilver()
    {
        return $this->prixsilver;
    }

    /**
     * @param float $prixsilver
     */
    public function setPrixsilver($prixsilver)
    {
        $this->prixsilver = $prixsilver;
    }

    /**
     * @return float
     */
    public function getPrixgold()
    {
        return $this->prixgold;
    }

    /**
     * @param float $prixgold
     */
    public function setPrixgold($prixgold)
    {
        $this->prixgold = $prixgold;
    }

    /**
     * @return float
     */
    public function getPrixdiamond()
    {
        return $this->prixdiamond;
    }

    /**
     * @param float $prixdiamond
     */
    public function setPrixdiamond($prixdiamond)
    {
        $this->prixdiamond = $prixdiamond;
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
     * @ORM\Column(name="photo",type="string", length=255, nullable=true)
     * @var string
     */
    private $photo;

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

}

