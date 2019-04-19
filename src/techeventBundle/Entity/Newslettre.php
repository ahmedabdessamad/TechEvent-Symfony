<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newslettre
 *
 * @ORM\Table(name="newslettre", indexes={@ORM\Index(name="IDX_F0C8D771A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_F0C8D77171F7E88B", columns={"event_id"})})
 * @ORM\Entity
 */
class Newslettre
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
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

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

