<?php

namespace AppelSponsorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inttereser
 *
 * @ORM\Table(name="inttereser", indexes={@ORM\Index(name="IDX_4D010524A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_4D01052471F7E88B", columns={"event_id"})})
 * @ORM\Entity
 */
class Inttereser
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


}

