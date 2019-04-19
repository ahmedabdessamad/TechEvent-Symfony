<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="IDX_67F068BCA76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @ORM\Column(name="contenuecom", type="string", length=255, nullable=false)
     */
    private $contenuecom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heurecom", type="datetime", nullable=false)
     */
    private $heurecom = 'CURRENT_TIMESTAMP';

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
     * @ORM\ManyToOne(targetEntity="techeventBundle\Entity\Article", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

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
    public function getContenuecom()
    {
        return $this->contenuecom;
    }

    /**
     * @param string $contenuecom
     */
    public function setContenuecom($contenuecom)
    {
        $this->contenuecom = $contenuecom;
    }

    /**
     * @return \DateTime
     */
    public function getHeurecom()
    {
        return $this->heurecom;
    }

    /**
     * @param \DateTime $heurecom
     */
    public function setHeurecom($heurecom)
    {
        $this->heurecom = $heurecom;
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
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

}

