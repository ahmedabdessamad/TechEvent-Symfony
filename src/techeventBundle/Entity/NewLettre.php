<?php

namespace techeventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewLettre
 *
 * @ORM\Table(name="new_lettre", indexes={@ORM\Index(name="IDX_F0C8D771A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_F0C8D77171F7E88B", columns={"event_id"})})
 * @ORM\Entity
 */
class NewLettre
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=true)
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;


}

