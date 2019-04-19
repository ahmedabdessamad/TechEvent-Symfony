<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention", indexes={@ORM\Index(name="IDX_D11814ABD04A0F27", columns={"speaker_id"})})
 * @ORM\Entity
 */
class Intervention
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
     * @ORM\Column(name="typeinter", type="string", length=255, nullable=false)
     */
    private $typeinter;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="heureInter", type="string", length=255, nullable=false)
     */
    private $heureinter;

    /**
     * @var \Speaker
     *
     * @ORM\ManyToOne(targetEntity="Speaker")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="speaker_id", referencedColumnName="id")
     * })
     */
    private $speaker;


}

