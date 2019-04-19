<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chat
 *
 * @ORM\Table(name="chat")
 * @ORM\Entity(repositoryClass="techeventBundle\Repository\chatRepository")
 */
class chat
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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="chat")
     * @ORM\JoinColumn(name="idsender", referencedColumnName="id")
     */
    private $idsender;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="chat")
     * @ORM\JoinColumn(name="idreceiver", referencedColumnName="id")
     */
    private $idreceiver;

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
     * Set content
     *
     * @param string $content
     *
     * @return chat
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getIdsender()
    {
        return $this->idsender;
    }

    /**
     * @param mixed $idsender
     */
    public function setIdsender($idsender)
    {
        $this->idsender = $idsender;
    }

    /**
     * @return mixed
     */
    public function getIdreceiver()
    {
        return $this->idreceiver;
    }

    /**
     * @param mixed $idreceiver
     */
    public function setIdreceiver($idreceiver)
    {
        $this->idreceiver = $idreceiver;
    }

}

