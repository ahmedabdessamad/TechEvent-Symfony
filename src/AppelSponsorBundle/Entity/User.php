<?php
// src/AppBundle/Entity/User.php

namespace AppelSponsorBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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


    /**
     * @var string
     *
     * @ORM\Column(name="raiting", type="string", length=180, nullable=true)
     */
    private $raiting;
    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=180, nullable=true)
     */
    private $role;

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
    public function getRaiting()
    {
        return $this->raiting;
    }

    /**
     * @param string $raiting
     */
    public function setRaiting($raiting)
    {
        $this->raiting = $raiting;
    }

}