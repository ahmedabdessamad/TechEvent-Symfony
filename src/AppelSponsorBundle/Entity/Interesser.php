<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interesser
 *
 * @ORM\Table(name="interesser", indexes={@ORM\Index(name="IDX_4D010524A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_4D01052471F7E88B", columns={"event_id"})})
 * @ORM\Entity
 */
class Interesser
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


}

