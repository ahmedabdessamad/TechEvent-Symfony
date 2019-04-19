<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archive
 *
 * @ORM\Table(name="archive")
 * @ORM\Entity(repositoryClass="techeventBundle\Repository\ArchiveRepository")
 */
class Archive
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
     * @ORM\Column(name="anas", type="string", length=255)
     */
    private $anas;


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
     * Set anas
     *
     * @param string $anas
     *
     * @return Archive
     */
    public function setAnas($anas)
    {
        $this->anas = $anas;

        return $this;
    }

    /**
     * Get anas
     *
     * @return string
     */
    public function getAnas()
    {
        return $this->anas;
    }
}

